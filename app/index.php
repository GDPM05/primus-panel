<?php

if (!defined('START'))
    exit('NO DIRECT ACCESS');

$uri = $_SERVER['REQUEST_URI'];

$uri_parameters = explode('/', $uri);

$path = $uri_parameters[2];

include_once PUBLIC_PATH . 'components/header.php';

include_once APP_PATH . $routes[$path];

include_once PUBLIC_PATH . 'components/footer.php';