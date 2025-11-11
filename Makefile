# Use -f to specify the path to the docker-compose file
DOCKER_COMPOSE = docker-compose -f docker/docker-compose.yaml
PHP_CONTAINER = php-atic-odp-xe

.PHONY: help build up down restart shell composer-install composer-update test test-coverage rector rector-dry-run console clean demo

help:
	@echo "Available commands:"
	@echo ""
	@echo "Docker Commands:"
	@echo "  make build              Build or rebuild the Docker images"
	@echo "  make up                 Start the services in the background"
	@echo "  make down               Stop and remove the services"
	@echo "  make restart            Restart the services"
	@echo "  make shell              Access the PHP container shell"
	@echo ""
	@echo "Composer Commands:"
	@echo "  make composer-install   Run composer install inside the container"
	@echo "  make composer-update    Run composer update inside the container"
	@echo ""
	@echo "Testing Commands:"
	@echo "  make test               Run PHPUnit tests"
	@echo "  make test-coverage      Run tests with coverage report"
	@echo ""
	@echo "Code Quality Commands:"
	@echo "  make rector             Run Rector to fix code (applies changes)"
	@echo "  make rector-dry-run     Run Rector in dry-run mode (shows changes)"
	@echo ""
	@echo "Application Commands:"
	@echo "  make demo               Run demo translator command"
	@echo "  make console            Run a Symfony console command (e.g., make console list)"
	@echo ""
	@echo "Utility Commands:"
	@echo "  make clean              Clean cache and temporary files"

# Docker commands
build:
	$(DOCKER_COMPOSE) build --no-cache

up:
	$(DOCKER_COMPOSE) up -d

down:
	$(DOCKER_COMPOSE) down

restart: down up

shell:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) bash

# Composer commands
composer-install:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) composer install

composer-update:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) composer update

# Testing commands
test:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) bin/phpunit

test-coverage:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) bin/phpunit --coverage-html var/coverage

# Code quality commands
rector:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) bin/rector process

rector-dry-run:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) bin/rector process --dry-run

# Application commands
demo:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) bin/console atico:demo:translator --sheet-name=common

# Allows running any Symfony command, e.g., `make console list`
console:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) bin/console $(filter-out $@,$(MAKECMDGOALS))

# Utility commands
clean:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) rm -rf var/cache/* var/log/*
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) bin/console cache:clear

# This is needed to pass arguments to the console command
%:
	@: