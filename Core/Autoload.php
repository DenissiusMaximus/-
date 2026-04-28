<?php

spl_autoload_register(function (string $className) {
    $basePath = dirname(__DIR__) . DIRECTORY_SEPARATOR;

    // Primary: resolve by namespace (e.g. DataAccess\DbContext -> DataAccess/DbContext.php)
    $filePath = $basePath . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    if (file_exists($filePath)) {
        require_once $filePath;
        return;
    }

    // Fallback: strip namespace, search common directories by class name only
    $shortName = basename(str_replace('\\', '/', $className));
    $directories = [
        'Core/',
        'Core/Middleware/',
        'Core/Builders/',
        'Core/Pipeline/',
        'Core/Attributes/',
        'Core/MVC/',
        'Models/',
        'Controllers/',
        'Views/',
        'Services/',
        'DataAccess/',
        'Repositories/',
        'Repositories/Interfaces/',
        'Middleware/',
        'Utils/',
        'Utils/Routing/',
    ];

    foreach ($directories as $directory) {
        $filePath = $basePath . $directory . $shortName . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
});