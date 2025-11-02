#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$file = $argv[1] ?? '/app/var/cache/downloaded_resource.xls';

try {
    $spreadsheet = IOFactory::load($file);
    $sheetNames = $spreadsheet->getSheetNames();

    echo "Available sheets in the Excel file:\n";
    foreach ($sheetNames as $index => $name) {
        echo "  [$index] $name\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
