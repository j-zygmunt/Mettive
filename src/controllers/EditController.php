<?php

require_once 'AppController.php';

class EditController extends AppController{

    const MAX_FILE_SIZE = 4048*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $message = [];

    public function editProfile(){
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $userProfile = new UserProfile("temp", $_FILES['file']['tmp_name'], "temp", "temp", "temp");

            $this->message[] = 'Profile successfully changed';
            return $this->render('my_profile', ['messages' => $this->message]);

        }
        $this->render('edit_profile', ['messages' => $this->message]);
    }

    private function validate(array $file): bool{
        if($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is to large for destination file system';
            return false;
        }

        if(!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported';
            return false;
        }

        return true;
    }
}