<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index() {
        //TODO login.html
        //die("index method");
        $this->render('login');
    }

    public function home() {
        //TODO home.html
        //die("home method");
        $this->render('home');
    }

    public function register() {
        //TODO home.html
        //die("register method");
        $this->render('register');
    }

}