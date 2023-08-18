<?php
#cash constants
define('CACHE_ENABLED', 1); //cache enabled
define('CACHE_DIR', __DIR__ . DIRECTORY_SEPARATOR . "Cache" . DIRECTORY_SEPARATOR); //cache directory address was created
#Authorization constants
define('JWT_KEY', 'sAd9Tq2kF5l0f5#fmkQ%dsf5HB');
define('JWT_ALG', 'HS256');

include_once "App/iran.php";
include_once "vendor/autoload.php";
spl_autoload_register(function ($class) {
    $classFile =  __DIR__ . '/' . str_replace('\\', '/', $class . '.php');
    // $classFile =  __DIR__ . DIRECTORY_SEPARATOR . "$class.php";
    if (!(file_exists($classFile) && is_readable($classFile)))
        die("$classFile not found");

    include_once $classFile;
});

// use \App\Utilities\Response;

// Response::respond([1, 2, 3], 200);
