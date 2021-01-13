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
}