<?php

require "Routing.php";

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('index', 'SecurityController');
Router::get('', 'SecurityController');
Router::get('home', 'UserController');
Router::get('profile', 'UserController');
Router::get('myProfile', 'UserController');
Router::get('follow', 'UserController');
Router::get('unfollow', 'UserController');
Router::post('addReview', 'ReviewController');
Router::post('register', 'SecurityController');
Router::post('login', 'SecurityController');
Router::post('editProfile', 'EditProfileController');
Router::post('search', 'UserController');
Router::post('logout', 'SecurityController');

Router::run($path);