<?php

require "Routing.php";

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('index', 'DefaultController');
Router::get('', 'DefaultController');
Router::get('home', 'DefaultController');
Router::get('register', 'DefaultController');

Router::run($path);