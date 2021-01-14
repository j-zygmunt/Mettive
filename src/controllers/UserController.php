<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserProfile.php';
require_once __DIR__.'/../models/Address.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/AddressRepository.php';

class UserController extends AppController
{
    private UserRepository $userRepository;
    private AddressRepository $addressRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->addressRepository = new AddressRepository();
    }

    public function home()
    {
        $this->checkCookie();
        $usersProfiles = $this->userRepository->getUsersProfiles();
        $addresses = $this->addressRepository->getAddresses();
        $this->render('home', ['usersProfiles' => $usersProfiles, 'addresses' => $addresses]);
    }

    public function search()
    {
        $this->checkCookie();

        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : "";

        if($contentType === "application/json")
        {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->userRepository->getUserProfileByName($decoded['searchInput']));
        }
    }

    public function myProfile()
    {
        $this->checkCookie();
        $id_user = intval($_COOKIE["user"]);
        $userProfile = $this->userRepository->getUserProfileById($id_user);
        $this->render('my-profile', ['userProfile' => $userProfile]);
    }
}