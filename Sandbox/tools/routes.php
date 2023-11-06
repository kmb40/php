<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [

    '/' => 'index.php',
    '/dd' => 'dd.php',
    '/routes' => 'routes.php'

];

?>