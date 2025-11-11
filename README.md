Spreadsheet Translator Symfony Demo Application
================================================

Symfony demo application that takes a Microsoft OneDrive spreadsheet and generates translation files in XLIFF format.

## Requirements

- PHP >= 8.4
- Symfony 7.0
- Docker & Docker Compose (recommended)

## Installation

```bash
composer create-project atico/translator-symfony-demo-onedrive-to-xliff
```

Demo spreadsheet: https://onedrive.live.com/embed?resid=F52C4DBF73226B55%%212071&authkey=%%21ANaIXSe9EB_Vywo&em=2&em=2&cid=F52C4DBF73226B55%%212071

Notice that this file cannot be opened via web browser but with the atico:demo:translator command.

## Running with Docker

### Quick Start

```bash
make build          # Build Docker images
make up             # Start services
make composer-install
make demo           # Run demo translator command
```

### Available Make Commands

**Docker Commands:**
```bash
make build              # Build or rebuild the Docker images
make up                 # Start the services in the background
make down               # Stop and remove the services
make restart            # Restart the services
make shell              # Access the PHP container shell
```

**Composer Commands:**
```bash
make composer-install   # Run composer install inside the container
make composer-update    # Run composer update inside the container
```

**Testing Commands:**
```bash
make test               # Run PHPUnit tests
make test-coverage      # Run tests with coverage report
```

**Code Quality Commands:**
```bash
make rector             # Run Rector to fix code (applies changes)
make rector-dry-run     # Run Rector in dry-run mode (shows changes)
```

**Application Commands:**
```bash
make demo               # Run demo translator command
make console [command]  # Run any Symfony console command
```

**Utility Commands:**
```bash
make clean              # Clean cache and temporary files
```

## Running Locally (Without Docker)

```bash
composer install
bin/console atico:demo:translator --sheet-name=common

# Run tests
vendor/bin/phpunit

# Run Rector
vendor/bin/rector process --dry-run
vendor/bin/rector process
```

## Testing

This project includes comprehensive unit tests for all components.

```bash
# Run all tests
make test

# Generate coverage report (saved to var/coverage/)
make test-coverage

# Run specific test
docker-compose -f docker/docker-compose.yaml exec php-atic-odp-xe vendor/bin/phpunit tests/Command/TranslatorCommandTest.php
```

## Code Quality

The project uses Rector for automated code refactoring and quality improvements.

```bash
# Check what changes Rector would make
make rector-dry-run

# Apply Rector changes
make rector
```

## Output

Translation files are generated in `translations/`:

```
translations/
  ├── demo_common.es_ES.xliff
  ├── demo_common.en_GB.xliff
  └── demo_common.it_IT.xliff
```

## OneDrive File Sharing

1. Open spreadsheet in OneDrive
2. Share → Embed → Generate code
3. Extract AUTHKEY from iframe code
4. Copy RESID and CID from URL
5. Build URL: `https://onedrive.live.com/embed?resid=RESID&authkey=AUTHKEY&em=2&cid=CID`

Note: Escape `%` characters in URL values by doubling them (`%%`)

## Related Projects

- [Symfony Bundle](https://github.com/samuelvi/spreadsheet-translator-symfony-bundle)
- [Local File to PHP Demo](https://github.com/samuelvi/translator-symfony-demo-local-file-to-php)
- [Google Drive to YML Demo](https://github.com/samuelvi/translator-symfony-demo-google-drive-provider-yml-exporter)

## CI/CD

The project includes GitHub Actions workflow for automated testing on every push and pull request.

## Dependencies

### Core Libraries
- `samuelvi/spreadsheet-translator-core`: ^8.4
- `samuelvi/spreadsheet-translator-symfony-bundle`: ^8.4
- `samuelvi/spreadsheet-translator-provider-onedrive`: ^8.4
- `samuelvi/spreadsheet-translator-reader-xlsx`: ^8.4
- `samuelvi/spreadsheet-translator-exporter-xliff`: ^8.4

### Symfony Components
- Symfony 7.0 (Console, Framework Bundle, Translation, etc.)

### Development Tools
- PHPUnit 11.5 for testing
- Rector 2.1 for code quality and refactoring

## License

Licensed under the MIT License. See LICENSE file for details.
