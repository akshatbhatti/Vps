<?php

$files = glob(__DIR__ . "/migrations/*.php");

foreach ($files as $file) {
    require_once $file;
}
