<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserProfile.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/AddressRepository.php';

class EditProfileController extends AppController
{
    private UserRepository $userRepository;
    private AddressRepository $addressRepository;

    const MAX_FILE_SIZE = 4048*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private array $message = [];

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->addressRepository = new AddressRepository();
    }

    public function editProfile()
    {
        $this->checkCookie();
        $id_user = intval($_COOKIE["user"]);
        $userProfile = $this->userRepository->getUserProfileById($id_user);
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validateFile($_FILES['file']))
        {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );
            if(strlen($_POST['new-about-me'])>=800){
                $this->message[] = "Description contains too many characters";
                $this->render('edit-profile', ['userProfile' => $userProfile, 'messages' => $this->message]);
            }

            $this->userRepository->editUserProfile($id_user, $_FILES['file']['name'], $_POST['new-about-me']);

            $url = "http://$_SERVER[HTTP_HOST]";
            header ("Location: {$url}/myProfile");
            return;
        }
        $this->render('edit-profile', ['userProfile' => $userProfile, 'messages' => $this->message]);
    }

    private function validateFile(array $file): bool
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