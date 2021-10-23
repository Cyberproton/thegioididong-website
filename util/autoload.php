<?php

function autoload($class)
{
    require_once __DIR__.'/../config/config.php';
    
    $root = PATH_ROOT;
    $prefix = '\\';

    $class_without_prefix = preg_replace('/^' . preg_quote($prefix) . '/', '', $class);
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class_without_prefix) . '.php';
    $path = $root . '/' . $file;
    if (file_exists($path)) 
    {
        require_once $path;
    }
}

spl_autoload_register('autoload');