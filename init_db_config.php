<?php

if (php_sapi_name() !== 'cli') {
    echo 'This cannot be done only through CLI.';
    exit;
}

$dbConfigFile = getcwd() . '/src/App/Config/db.php';

if (file_exists($dbConfigFile)) {
    echo 'Database config file already exists.' . PHP_EOL;
    return;
}

$dbConfig = [];

$fp = fopen($dbConfigFile, 'wb');

echo 'Enter db host: ' . PHP_EOL;
$dbHost = trim(fgets(STDIN));

echo 'Enter db name: ' . PHP_EOL;
$dbName = trim(fgets(STDIN));

$dbConfig['dsn'] = "pgsql:host={$dbHost};dbname={$dbName};";

echo 'Enter db username: ' . PHP_EOL;
$dbConfig['username'] = trim(fgets(STDIN));

echo 'Enter db password: ' . PHP_EOL;
$dbConfig['password'] = trim(fgets(STDIN));

fwrite(
    $fp,
    "<?php
    
return " . var_export($dbConfig, true) .
    ";"
);

fclose($fp);