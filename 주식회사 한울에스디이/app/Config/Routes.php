<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');


/**
 * 한울 라우터
 */
$routesDirectory = APPPATH.'Config/Routes/';
$files = new DirectoryIterator($routesDirectory);
foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        require $routesDirectory . $file->getFilename();
    }
}