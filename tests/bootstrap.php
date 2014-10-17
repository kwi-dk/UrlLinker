<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function includeIfExists($file)
{
    return file_exists($file) ? include $file : false;
}

if (!includeIfExists(__DIR__.'/../vendor/autoload.php')) {
    echo 'You must set up the project dependencies, run the following commands:'.PHP_EOL.
        'curl -sS https://getcomposer.org/installer | php'.PHP_EOL.
        'php composer.phar install'.PHP_EOL;
    exit(1);
}
