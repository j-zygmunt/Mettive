<?php

require_once 'AppController.php';

class DefaultController extends AppController
{

    public function index(): void
    {
        $this->render('login');
    }

    public function home(): void
    {
        $this->render('home');
    }

    public function profile(): void
    {
        $this->render('profile');
    }

    public function my_profile(): void
    {
        $this->render('my_profile');
    }

    public function register(): void
    {
        $this->render('register');
    }

    public function edit_profile(): void
    {
        $this->render('edit_profile');
    }

}