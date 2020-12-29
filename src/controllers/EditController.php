<?php

require_once 'AppController.php';

class EditController extends AppController{

    public function editProfile(){
        $this->render('edit-profile');
    }
}