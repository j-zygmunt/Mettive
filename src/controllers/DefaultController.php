<?php

require_once 'AppController.php';

class DefaultController extends AppController
{
    public function index(): void
    {
        $url = "http://$_SERVER[HTTP_HOST]";
        if(isset($_COOKIE['user'])) {
            header("Location: {$url}/home");
        }
        header("Location: {$url}/login");
    }
}