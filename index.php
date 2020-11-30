<?php

define('DB_SERVER', 'localhost');
define('DB_NAME', 'blog');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('BASE_URL', str_replace('index.php', '', $_SERVER['PHP_SELF']));

spl_autoload_register(function ($class_name) {
    include $class_name.'.php';
});

$router = new Router;
$router->route();

