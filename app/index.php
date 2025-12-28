<?php

if (!defined('START'))
    exit('NO DIRECT ACCESS');

$uri = $_SERVER['REQUEST_URI'];

$uri_parameters = explode('/', $uri);

$path = $uri_parameters[2];

if ($path == "stats") {
    
}

include_once PUBLIC_PATH . 'components/header.php';



include_once PUBLIC_PATH . 'components/footer.php';