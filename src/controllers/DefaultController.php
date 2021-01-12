<?php

require_once 'AppController.php';

class DefaultController extends AppController
{

    public function index(): void
    {
        $this->render('login');
    }

    public function profile(): void
    {
        $this->render('profile');
    }

    public function myProfile(): void
    {
        $this->render('my-profile');
    }

    public function register(): void
    {
        $this->render('register');
    }

    public function editProfile(): void
    {
        $this->render('edit-profile');
    }

}