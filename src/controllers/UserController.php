<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserProfile.php';
require_once __DIR__.'/../models/UserStats.php';
require_once __DIR__.'/../models/Address.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/AddressRepository.php';
require_once __DIR__.'/../repository/ReviewRepository.php';

class UserController extends AppController
{
    private UserRepository $userRepository;
    private AddressRepository $addressRepository;
    private ReviewRepository $reviewRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->addressRepository = new AddressRepository();
        $this->reviewRepository = new ReviewRepository();
    }

    public function home()
    {
        $this->checkCookie();
        $id = intval($_COOKIE['user']);
        $usersProfiles = $this->userRepository->getUsersProfiles($id);
        $addresses = $this->addressRepository->getAddresses();
        $this->render('home', ['usersProfiles' => $usersProfiles, 'addresses' => $addresses]);
    }

    public function search()
    {
        $this->checkCookie();
        $id = intval($_COOKIE['user']);

        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : "";

        if($contentType === "application/json")
        {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->userRepository->getUserProfileByName($decoded['searchInput'], $id));
        }
    }

    public function myProfile(): void
    {
        $this->checkCookie();
        $id_user = intval($_COOKIE["user"]);
        $userProfile = $this->userRepository->getUserProfileById($id_user);
        $stats = $this->userRepository->getUserStats($id_user);
        $reviews = $this->reviewRepository->getReviews($id_user);
        $this->render('my-profile', ['userProfile' => $userProfile, 'stats' => $stats, 'reviews' => $reviews]);
    }

    public function profile($email): void
    {
        $this->checkCookie();
        if(is_string($email))
        {
            $visitor = intval($_COOKIE["user"]);
            $profile = $this->userRepository->getUserProfile($email, $visitor);
            $id = $profile->getId();
            if($id == $visitor){
                $url = "http://$_SERVER[HTTP_HOST]";
                header ("Location: {$url}/home");
            }
            $stats = $this->userRepository->getUserStats($id);
            $reviews = $this->reviewRepository->getReviews($id);
            $this->render('profile', ['profile' => $profile, 'stats' => $stats, 'visitor' => $visitor, 'reviews' => $reviews]);
        }
        else{
            $url = "http://$_SERVER[HTTP_HOST]";
            header ("Location: {$url}/home");
        }
    }

    public function follow(int $idAddressee): void
    {
        $this->checkCookie();
        $idUser = intval($_COOKIE["user"]);
        $this->userRepository->follow($idUser, $idAddressee);
        http_response_code(200);
    }

    public function unfollow(int $idAddressee): void
    {
        $this->checkCookie();
        $idUser = intval($_COOKIE["user"]);
        $this->userRepository->unfollow($idUser, $idAddressee);
        http_response_code(200);
    }
}