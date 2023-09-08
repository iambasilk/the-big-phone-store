<?php

spl_autoload_register(function ($className) {
    $rootDirectory = __DIR__ . '/..';

    $filePath = $rootDirectory . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
    }
});
