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

    public function index(): void
    {
        $url = "http://$_SERVER[HTTP_HOST]";
        header ("Location: {$url}/login");
    }

    public function login()
    {
        if(isset($_COOKIE['user']))
        {
            setcookie('user', "", time() - 900);
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/");
        }

        if(!$this->isPost())
        {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];
        $user = $this->userRepository->getUser($email);

        if(!$user)
        {
            return $this->render('login', ['messages' => ["User not exist"]]);
        }

        if ($user->getEmail() !== $email || !password_verify($password, $user->getPassword()))
        {
            return $this->render('login', ['messages' => ["Wrong email or password!"]]);
        }

        setcookie("user", $user->getId(), time() + 900);
        //TODO change enable flag

        $url = "http://$_SERVER[HTTP_HOST]";
        header ("Location: {$url}/home");
    }

    public function logout()
    {
        $this->checkCookie();
        setcookie('user', "", time() - 900);
        //TODO change enable flag
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/");
    }

    public function register()
    {
        if(!$this->isPost())
        {
            return $this->render('register');
        }

        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $language = $_POST["language"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $repeatedPassword = $_POST["repeat-password"];

        if(!$name || !$surname || !$language || !$email){
            return $this->render('register', ['messages' => ["Missing input data"]]);
        }

        if(!isset($_POST["accept"])){
            return $this->render('register', ['messages' => ["You have to accept terms and conditions"]]);
        }

        if($repeatedPassword !== $password)
        {
            return $this->render('register', ['messages' => ["Passwords don't match"]]);
        }

        if(!preg_match('/^(?=.*\d)(?=.*[A-Z]).{6,100}$/', $password))
        {
            return $this->render(
                'register',
                ['messages' => ["Password must be at least 6 characters long and must contain one digit and one capital letter"]]
            );
        }

        $languageObj = new Lang($language);
        $this->languageRepository->addLanguage($languageObj);
        $user = new User($email, password_hash($password, PASSWORD_DEFAULT));
        $userProfile = new UserProfile('default.jpg', $name, $surname, $language, null);
        $this->userRepository->addUserProfile($user, $userProfile);

        //TODO change enable flag

        $url = "http://$_SERVER[HTTP_HOST]";
        header ("Location: {$url}/home");
    }
}