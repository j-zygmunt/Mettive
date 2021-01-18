<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserProfile.php';
require_once __DIR__.'/../models/UserStats.php';

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
            $user['password'],
            $user['id_user']
        );
    }

    public function getUserProfile(string $email, int $idCurrentUser): ?UserProfile
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM v_users_profiles u left join
                (SELECT f.id_addressee as is_friend FROM (users JOIN followers f ON ((users.id_user = f.id_addressee)))
                WHERE (f.id_requester = :id)) t on u.id_user = t.is_friend WHERE email = :email;
        ');
        $statement->bindParam(':id', $idCurrentUser, PDO::PARAM_INT);
        $statement->bindParam(':email', $email, PDO::PARAM_INT);
        $statement->execute();

        $userProfile = $statement->fetch(PDO::FETCH_ASSOC);

        if($userProfile == false)
        {
            //TODO optional exception
            return null;
        }

        return new UserProfile(
            $userProfile['id_user'],
            $userProfile['email'],
            $userProfile['image'],
            $userProfile['name'],
            $userProfile['surname'],
            $userProfile['about_me'],
            $userProfile['language'],
            $userProfile['country'],
            $userProfile['city'],
            $userProfile['is_friend']
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
            INSERT INTO public.users_details (name, surname, image, id_main_language)
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

    public function getUsersProfiles(int $idCurrentUser): array
    {
        $result = [];

        $statement = $this->database->connect()->prepare('
            SELECT * FROM v_users_profiles u left join
                (SELECT f.id_addressee as is_friend FROM (users JOIN followers f ON ((users.id_user = f.id_addressee)))
                WHERE (f.id_requester = :id)) t on u.id_user = t.is_friend WHERE u.id_user <> :id;
        ');
        $statement->bindParam(':id', $idCurrentUser, PDO::PARAM_INT);
        $statement->execute();
        $usersProfiles = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($usersProfiles as $userProfile)
        {
            $result[] = new UserProfile(
                $userProfile['id_user'],
                $userProfile['email'],
                $userProfile['image'],
                $userProfile['name'],
                $userProfile['surname'],
                $userProfile['about_me'],
                $userProfile['language'],
                $userProfile['country'],
                $userProfile['city'],
                $userProfile['is_friend']
            );
        }

        return $result;
    }

    public function getUserProfileByName(string $searchString, int $idCurrentUser): ?array
    {
        $searchString = '%'.strtolower($searchString).'%';

        $statement = $this->database->connect()->prepare('
            SELECT id_user FROM v_users_profiles_fullname WHERE LOWER(name) LIKE :search AND id_user <> :id
        ');
        $statement->bindParam(':id', $idCurrentUser, PDO::PARAM_INT);
        $statement->bindParam(':search', $searchString, PDO::PARAM_STR);
        $statement->execute();
        $temp = $statement->fetchAll(PDO::FETCH_ASSOC);

        if($temp == false){
            return null;
        }

        $ids = [];

        foreach ($temp as $item) {
            $ids[] = $item['id_user'];
        }
        $ids = array_values($ids);
        $ids = implode(', ', $ids);


        $sql = ('SELECT * FROM v_users_profiles u left join
                (SELECT f.id_addressee as is_friend FROM (users JOIN followers f ON ((users.id_user = f.id_addressee)))
                WHERE (f.id_requester = ' . $idCurrentUser . ')) t on u.id_user = t.is_friend where id_user in (' . $ids . ')');

        return $this->database->connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserProfileById(int $id): ?UserProfile
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM v_users_profiles WHERE id_user = :id
        ');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $userProfile = $statement->fetch(PDO::FETCH_ASSOC);

        if($userProfile == false)
        {
            //TODO optional exception
            return null;
        }

        return new UserProfile(
            $userProfile['id_user'],
            $userProfile['email'],
            $userProfile['image'],
            $userProfile['name'],
            $userProfile['surname'],
            $userProfile['about_me'],
            $userProfile['language'],
            $userProfile['country'],
            $userProfile['city']
        );
    }

    public function editUserProfile(int $id_user, string $image, string $aboutMe, int $idAddress): void
    {
        $statement = $this->database->connect()->prepare('
            SELECT id_user_details FROM public.users WHERE id_user = :id
        ');
        $statement->bindParam(':id', $id_user, PDO::PARAM_INT);
        $statement->execute();

        $profileId = $statement->fetch(PDO::FETCH_ASSOC);

        $statement = $this->database->connect()->prepare('
            UPDATE users_details SET image = :image, about_me = :aboutMe, id_address = :idAddress WHERE id_user_details = :profileId
        ');
        $statement->bindParam(':image', $image, PDO::PARAM_STR);
        $statement->bindParam(':aboutMe', $aboutMe, PDO::PARAM_STR);
        $statement->bindParam(':profileId', $profileId['id_user_details'], PDO::PARAM_STR);
        $statement->bindParam(':idAddress', $idAddress, PDO::PARAM_STR);
        $statement->execute();
    }

    public function getUserStats(int $idUser): UserStats
    {
        $statement = $this->database->connect()->prepare('
        SELECT * FROM v_users_stats WHERE id_user = :id_user
        ');
        $statement->bindParam(':id_user', $idUser, PDO::PARAM_INT);
        $statement->execute();
        $stats = $statement->fetch(PDO::FETCH_ASSOC);

        return new UserStats(
            $stats['avg'],
            $stats['followers_amount'],
            $stats['following_amount'],
            $stats['sum'],
            $stats['created_at']
        );
    }

    public function checkMailAvailability(string $email): bool
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM users WHERE email = :email
        ');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        $mail = $statement->fetch(PDO::FETCH_ASSOC);
        if($mail != false){
            return true;
        }
        return false;
    }

    public function follow(int $idFollower, int $idFollowee): void
    {
        $statement = $this->database->connect()->prepare('
            INSERT INTO followers (id_requester, id_addressee)
            VALUES (?, ?)
        ');
        $statement->execute([
            $idFollower,
            $idFollowee
        ]);

        $statement = $this->database->connect()->prepare('
            UPDATE users_details SET "followers_amount" = "followers_amount" + 1 FROM users_details JOIN users ON users.id_user_details = users_details.id_user_details WHERE id_user = :id
        ');
        $statement->bindParam(':id', $idFollowee, PDO::PARAM_INT);
        $statement->execute();

        $statement = $this->database->connect()->prepare('
            UPDATE users_details SET "following_amount" = "following_amount" + 1 FROM users_details JOIN users ON users.id_user_details = users_details.id_user_details WHERE id_user = :id
        ');
        $statement->bindParam(':id', $idFollower, PDO::PARAM_INT);
        $statement->execute();
    }

    public function unfollow(int $idFollower, int $idFollowee): void
    {
        $statement = $this->database->connect()->prepare('
            DELETE FROM followers WHERE id_requester = :id_requester AND id_addressee = :id_addressee
        ');
        $statement->bindParam(':id_requester', $idFollower, PDO::PARAM_INT);
        $statement->bindParam(':id_addressee', $idFollowee, PDO::PARAM_INT);
        $statement->execute();

        $statement = $this->database->connect()->prepare('
            UPDATE users_details SET "followers_amount" = "followers_amount" - 1 FROM users_details JOIN users ON users.id_user_details = users_details.id_user_details WHERE id_user = :id
        ');
        $statement->bindParam(':id', $idFollowee, PDO::PARAM_INT);
        $statement->execute();

        $statement = $this->database->connect()->prepare('
            UPDATE users_details SET "following_amount" = "following_amount" - 1 FROM users_details JOIN users ON users.id_user_details = users_details.id_user_details WHERE id_user = :id
        ');
        $statement->bindParam(':id', $idFollower, PDO::PARAM_INT);
        $statement->execute();
    }
}