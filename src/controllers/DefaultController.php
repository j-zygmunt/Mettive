<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index() {

        $this->render('login');
    }

    public function home() {

        $this->render('home');
    }

    public function profile(){

        $this->render('profile');
    }

    public function my_profile(){

        $this->render('my_profile');
    }

    public function register() {

        $this->render('register');
    }

}