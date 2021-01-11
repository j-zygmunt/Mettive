<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string  $email): ?User
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
        ');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user == false)
        {
            //TODO optional exception
            return null;
        }

        return new User(
            $user['email'],
            $user['password']
        );
    }

    public function getUserProfile(string $email): ?UserProfile
    {
        $statement = $this->database->connect()->prepare('
            SELECT email, name, surname, about_me, followers_amount, following_amount FROM public.users u 
            JOIN public.users_details ud ON u.id_user_details=ud.id_user_details WHERE u.email = :email
        ');
        $statement->bindParam(':email', $email, PDO::PARAM_INT);
        $statement->execute();

        $userProfile = $statement->fetch(PDO::FETCH_ASSOC);

        if($userProfile == false)
        {
            //TODO optional exception
            return null;
        }

        return new UserProfile(
            $userProfile['email'],
            $userProfile['image'],
            $userProfile['name'],
            $userProfile['surname'],
            $userProfile['about_me'],
            $userProfile['followers_amount'],
            $userProfile['following_amount']
        );
    }

    public function addUserProfile(User $user, UserProfile $userProfile)
    {
        $statement = $this->database->connect()->prepare('
            INSERT INTO public.users_details (name, surname, about_me, image)
            VALUES (?, ?, ?, ?)
        ');

        $statement->execute([
            $userProfile->getName(),
            $userProfile->getSurname(),
            $userProfile->getAboutMe(),
            $userProfile->getPhoto()
        ]);

        $id = $this->database->connect()->lastInsertId();

        $statement = $this->database->connect()->prepare('
            INSERT INTO public.users (email, password, id_user_details)
            VALUES (?, ?, ?)
        ');

        $statement->execute([
            $user->getEmail(),
            $user->getPassword(),
            $id
        ]);
    }
}