<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    private UserRepository $userRepository;
    private LanguageRepository $languageRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
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

        //return $this->render('home');
        $url = "http://$_SERVER[HTTP_HOST]";
        header ("Location: {$url}/home");
    }

    public function register()
    {
        if(!$this->isPost())
        {
            return $this->render('register');
        }

        $name = $_POST["name"];
        $language = $_POST["language"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $repeatedPassword = $_POST["repeat-password"];

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

        $language = new Lang($language);
        //$this->languageRepository->addLanguage($language);
        $user = new User($email, password_hash($password, PASSWORD_DEFAULT));
        $userProfile = new UserProfile($email, 'default.jpg', $name, $surname, $language, null, null);
        $this->userRepository->addUserProfile($user, $userProfile);

        $url = "http://$_SERVER[HTTP_HOST]";
        header ("Location: {$url}/home");
    }
}