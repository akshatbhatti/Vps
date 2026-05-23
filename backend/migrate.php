<?php
require_once __DIR__ . "/db.php";

$files = glob(__DIR__ . "/migrations/*.php");

foreach ($files as $file) {
    $sql = require $file;
    $conn->exec($sql);
    echo basename($file) . " migrated successfully\n";
}
