<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/UserController.php';
require_once 'src/controllers/EditProfileController.php';

class Router
{
    public static array $routes;

    public static function get (string $url, string $view)
    {
        self::$routes[$url] = $view;
    }

    public static function post (string $url, string $view)
    {
        self::$routes[$url] = $view;
    }

    public static function run (string $url)
    {
        $result = explode("/", $url);
        $action = $result[0];
        $sub = $result[1];

        if(!array_key_exists($action, self::$routes))
        {
            die("wrong url!");
        }
        
        $controller = self::$routes[$action];
        $object = new $controller;
        $sub = $sub ?? '';
        $action = $action ?: 'index';

        $object->$action($sub);
    }

}