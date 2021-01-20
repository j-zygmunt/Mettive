<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserProfile.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/LanguageRepository.php';
require_once __DIR__.'/../models/Lang.php';

class SecurityController extends AppController
{
    private UserRepository $userRepository;
    private LanguageRepository $languageRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->languageRepository = new LanguageRepository();
    }

    public function login(): void
    {
        $url = "http://$_SERVER[HTTP_HOST]";
        if(isset($_COOKIE['user'])) {
            header("Location: {$url}/home");
        }

        if(!$this->isPost()) {
            $this->render('login');
            return;
        }

        $email = $_POST["email"];
        $password = $_POST["password"];
        $user = $this->userRepository->getUser($email);

        if(!$user) {
            $this->render('login', ['messages' => ["User not exist"]]);
            return;
        }

        if ($user->getEmail() !== $email || !password_verify($password, $user->getPassword())) {
            $this->render('login', ['messages' => ["Wrong email or password!"]]);
            return;
        }

        setcookie("user", $user->getId(), time() + 3600);
        setcookie("role", $user->getRole(), time() + 3600);
        $this->userRepository->login($user->getId());

        header ("Location: {$url}/home");
    }

    public function logout(): void
    {
        $this->checkCookie();
        $id = intval($_COOKIE['user']);

        setcookie('user', "", time() - 3600);
        setcookie('role', "", time() - 3600);
        $this->userRepository->logout($id);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/");
    }

    public function register(): void
    {
        if(!$this->isPost()) {
            $this->render('register');
            return;
        }

        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $language = $_POST["language"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $repeatedPassword = $_POST["repeat-password"];

        if(!$name || !$surname || !$language || !$email){
            $this->render('register', ['messages' => ["Missing input data"]]);
            return;
        }

        if(!isset($_POST["accept"])){
            $this->render('register', ['messages' => ["You have to accept terms and conditions"]]);
            return;
        }

        if($repeatedPassword !== $password) {
            $this->render('register', ['messages' => ["Passwords don't match"]]);
            return;
        }

        if(!preg_match('/^(?=.*\d)(?=.*[A-Z]).{6,100}$/', $password)) {
            $this->render('register', ['messages' => ["Password must be at least 6 characters long and must contain one digit and one capital letter"]]
            );
            return;
        }

        if($this->userRepository->checkMailAvailability($email)){
            $this->render('register', ['messages' => ["User witch this email already exist"]]
            );
            return;
        }

        $languageObj = new Lang($language);
        $this->languageRepository->addLanguage($languageObj);
        $user = new User($email, password_hash($password, PASSWORD_DEFAULT));
        $userProfile = new UserProfile($email,'default.jpg', $name, $surname, null, $language, null, null, null);
        $this->userRepository->addUserProfile($user, $userProfile);

        $url = "http://$_SERVER[HTTP_HOST]";
        header ("Location: {$url}/login");
    }
}