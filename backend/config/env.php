<?php

$env = parse_ini_file(__DIR__ . '/../.env');
// print_r($env);

foreach ($env as $key => $value) {
   $_ENV[$key] = $value;
}

//print_r($_ENV);