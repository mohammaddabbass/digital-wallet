<?php
$folder = __DIR__ . "/migrations";

$files = glob($folder . "/*.php");

sort($files);

foreach ($files as $file) {
    echo "Running migration: " . basename($file) . "\n";
    require_once $file;
}

echo "All migrations executed.\n";
?>