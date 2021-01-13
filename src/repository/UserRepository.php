<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserProfile.php';

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
            SELECT * FROM public.v_users_profiles WHERE email = :email
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
            $userProfile['image'],
            $userProfile['name'],
            $userProfile['surname'],
            $userProfile['about_me'],
            $userProfile['mainLanguage'],
            $userProfile['country'],
            $userProfile['city'],
            $userProfile['followers_amount'],
            $userProfile['following_amount']
        );
    }

    public function addUserProfile(User $user, UserProfile $userProfile): void
    {
        $db = $this->database->connect();

        try {
            $language = $userProfile->getMainLanguage();

            $statement = $db->prepare('
                SELECT id_language FROM public.languages WHERE language = :language
            ');
            $statement->bindParam(':language', $language, PDO::PARAM_STR);
            $statement->execute();

            $language_id = $statement->fetch(PDO::FETCH_ASSOC);

            $statement = $db->prepare('
            INSERT INTO public.users_details (name, surname, about_me, image, id_main_language)
            VALUES (?, ?, ?, ?, ?)
            ');

            $db->beginTransaction();

            $statement->execute([
                $userProfile->getName(),
                $userProfile->getSurname(),
                $userProfile->getAboutMe(),
                $userProfile->getPhoto(),
                $language_id,
            ]);

            $id = $db->lastInsertId();

            $statement = $db->prepare('
            INSERT INTO public.users (email, password, id_user_details)
            VALUES (?, ?, ?)
        ');

            $statement->execute([
                $user->getEmail(),
                $user->getPassword(),
                $id
            ]);

            $db->commit();
        }
        catch(PDOException $error){
            if($db->inTransaction()){
                $db->rollBack();
            }
            throw $error;
        }
    }

    public function getUsersProfiles(): array
    {
        $result = [];

        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.v_users_profiles
        ');
        $statement->execute();
        $usersProfiles = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($usersProfiles as $userProfile)
        {
            $result[] = new UserProfile(
                $userProfile['image'],
                $userProfile['name'],
                $userProfile['surname'],
                $userProfile['about_me'],
                $userProfile['mainLanguage'],
                $userProfile['country'],
                $userProfile['city'],
                $userProfile['followers_amount'],
                $userProfile['following_amount']
            );
        }

        return $result;
    }

    public function getUserByName(string $searchString): array
    {
        $searchString = '%'.strtolower($searchString).'%';

        $statement = $this->database->connect()->prepare('
            SELECT * FROM v_users_profiles WHERE LOWER(name) LIKE :search OR LOWER(surname) LIKE :search
        ');
        $statement->bindParam(':search', $searchString, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}