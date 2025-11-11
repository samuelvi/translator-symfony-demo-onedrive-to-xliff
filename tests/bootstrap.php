<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

// Custom error handler to suppress warnings from vendor code
set_error_handler(fn(int $errno, string $errstr, string $errfile, int $errline): bool =>
    // Suppress warnings from the spreadsheet-translator-core vendor package
    // For all other errors, let PHP handle them normally
    // Return true to prevent PHP's internal error handler from running
    $errno === E_WARNING && str_contains($errfile, 'spreadsheet-translator-core'));
