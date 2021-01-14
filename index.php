<?php

require "Routing.php";

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('index', 'SecurityController');
Router::get('', 'SecurityController');
Router::get('home', 'UserController');
Router::get('profile', 'DefaultController');
Router::get('myProfile', 'UserController');
Router::get('register', 'SecurityController');
Router::post('login', 'SecurityController');
Router::post('editProfile', 'EditProfileController');
Router::post('search', 'UserController');
Router::post('logout', 'SecurityController');

Router::run($path);