<?php
define('DIR_ROOT', (__DIR__));

$http = 'http';
$isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443;
if ($isSecure)
    $http = 'https';

//Root URL
define('HTTP_ROOT',
    $http . '://'.$_SERVER['HTTP_HOST'].
    str_replace(
        $_SERVER['DOCUMENT_ROOT'],
        '',
        str_replace('\\', '/', DIR_ROOT).'/src'
    )
);

// Root path for src
define('ASSET_ROOT',
    $http . '://'.$_SERVER['HTTP_HOST'].
    str_replace(
        $_SERVER['DOCUMENT_ROOT'],
        '',
        str_replace('\\', '/', DIR_ROOT).'/src'
    )
);
// Root path for src
define('PATH_ROOT',
    $http . '://'.$_SERVER['HTTP_HOST'].
    str_replace(
        $_SERVER['DOCUMENT_ROOT'],
        '',
        str_replace('\\', '/', DIR_ROOT).''
    )
);

