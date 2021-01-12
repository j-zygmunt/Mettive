<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserProfile.php';
require_once __DIR__.'/../repository/UserRepository.php';

class UserController extends AppController
{
    private UserRepository $userRepository;

    const MAX_FILE_SIZE = 4048*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private array $message = [];

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function home()
    {
        $usersProfiles = $this->userRepository->getUsersProfiles();
        $this->render('home', ['usersProfiles' => $usersProfiles]);
    }

    public function editProfile()
    {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
        {
            //$userProfile = $this->userRepository->getUserProfile()
            //if()
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $userProfile = new UserProfile(
                "temp",
                $_FILES['file']['name'],
                "temp",
                "temp",
                $_POST['new-about-me'],
            );
            $url = "http://$_SERVER[HTTP_HOST]";
            header ("Location: {$url}/myProfile");
            return;
        }
        $this->render('edit-profile', ['messages' => $this->message]);
    }

    private function validate(array $file): bool
    {
        if($file['size'] > self::MAX_FILE_SIZE)
        {
            $this->message[] = 'File is to large for destination file system';
            return false;
        }

        if(!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES))
        {
            $this->message[] = 'File type is not supported';
            return false;
        }

        return true;
    }
}