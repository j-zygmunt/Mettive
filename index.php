<?php

require "Routing.php";

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('index', 'DefaultController');
Router::get('', 'DefaultController');
Router::get('home', 'UserController');
Router::get('profile', 'DefaultController');
Router::get('myProfile', 'DefaultController');
Router::get('register', 'SecurityController');
Router::post('login', 'SecurityController');
Router::post('editProfile', 'UserController');

Router::run($path);