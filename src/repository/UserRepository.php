<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserProfile.php';
require_once __DIR__.'/../models/UserStats.php';

class UserRepository extends Repository
{

    public function getUser(string  $email): ?User
    {
        $db = $this->database->connect();

        $statement = $db->prepare('
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
            $user['id_user'],
            $user['id_role']
        );
    }

    public function getUserProfile(string $email, int $idCurrentUser): ?UserProfile
    {
        $db = $this->database->connect();

        $statement = $db->prepare('
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
            $userProfile['email'],
            $userProfile['image'],
            $userProfile['name'],
            $userProfile['surname'],
            $userProfile['about_me'],
            $userProfile['language'],
            $userProfile['country'],
            $userProfile['city'],
            $userProfile['id_user'],
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
            VALUES (?, ?, ?, ?)
            ');

            $db->beginTransaction();

            $statement->execute([
                $userProfile->getName(),
                $userProfile->getSurname(),
                $userProfile->getPhoto(),
                $language_id['id_language'],
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
            //TODO
        }
    }

    public function getUsersProfiles(int $idCurrentUser): ?array
    {
        $db = $this->database->connect();
        $result = [];

        $statement = $db->prepare('
            SELECT * FROM v_users_profiles u left join
                (SELECT f.id_addressee as is_friend FROM (users JOIN followers f ON ((users.id_user = f.id_addressee)))
                WHERE (f.id_requester = :id)) t on u.id_user = t.is_friend WHERE u.id_user <> :id;
        ');
        $statement->bindParam(':id', $idCurrentUser, PDO::PARAM_INT);
        $statement->execute();
        $usersProfiles = $statement->fetchAll(PDO::FETCH_ASSOC);

        if($usersProfiles == false)
        {
            //TODO optional exception
            return null;
        }

        foreach ($usersProfiles as $userProfile)
        {
            $result[] = new UserProfile(
                $userProfile['email'],
                $userProfile['image'],
                $userProfile['name'],
                $userProfile['surname'],
                $userProfile['about_me'],
                $userProfile['language'],
                $userProfile['country'],
                $userProfile['city'],
                $userProfile['id_user'],
                $userProfile['is_friend']
            );
        }

        return $result;
    }

    public function getUserProfileByName(string $fullName, int $idCurrentUser, string $country, string $city, string $language): ?array
    {
        $db = $this->database->connect();
        $fullName = '%'.strtolower($fullName).'%';
        $country = '%'.strtolower($country).'%';
        $city = '%'.strtolower($city).'%';
        $language = '%'.strtolower($language).'%';

        $statement = $db->prepare('
            SELECT id_user FROM v_users_profiles_fullname WHERE 
            LOWER(name) LIKE :fullName AND
            LOWER(country) LIKE :country AND
            LOWER(city) LIKE :city AND
            LOWER(language ) LIKE :language AND 
            id_user <> :id
        ');
        $statement->bindParam(':id', $idCurrentUser, PDO::PARAM_INT);
        $statement->bindParam(':fullName', $fullName, PDO::PARAM_STR);
        $statement->bindParam(':country', $country, PDO::PARAM_STR);
        $statement->bindParam(':city', $city, PDO::PARAM_STR);
        $statement->bindParam(':language', $language, PDO::PARAM_STR);
        $statement->execute();
        $temp = $statement->fetchAll(PDO::FETCH_ASSOC);

        if($temp == false)
        {
            //TODO optional exception
            return null;
        }

        $ids = [];

        foreach ($temp as $item) {
            $ids[] = $item['id_user'];
        }
        $ids = array_values($ids);
        $ids = implode(', ', $ids);

        $sql = ('SELECT * FROM v_users_profiles u left join
                (SELECT f.id_addressee as is_friend FROM 
                (users JOIN followers f ON ((users.id_user = f.id_addressee))) WHERE (f.id_requester = ' . $idCurrentUser . ')) t on u.id_user = t.is_friend 
                where id_user in (' . $ids . ')');

        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserProfileById(int $id): ?UserProfile
    {
        $db = $this->database->connect();

        $statement = $db->prepare('
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
            $userProfile['email'],
            $userProfile['image'],
            $userProfile['name'],
            $userProfile['surname'],
            $userProfile['about_me'],
            $userProfile['language'],
            $userProfile['country'],
            $userProfile['city'],
            $userProfile['id_user'],
        );
    }

    public function editUserProfile(int $id_user, ?string $image, ?string $aboutMe, ?int $idAddress): void
    {
        if ($image == null && $aboutMe == '' && $idAddress == null) {
            return;
        }

        $db = $this->database->connect();

        $statement = $db->prepare('
            SELECT id_user_details FROM public.users WHERE id_user = :id
        ');
        $statement->bindParam(':id', $id_user, PDO::PARAM_INT);
        $statement->execute();

        $profileId = $statement->fetch(PDO::FETCH_ASSOC);
        $id = $profileId['id_user_details'];

        $query = "UPDATE users_details SET";

        $flag = false;

        if ($aboutMe != '') {
            $query = $query . " about_me = '" . $aboutMe . "'";
            $flag = true;
        }

        if ($image != null){
            if ($flag) {
                $query = $query . ",";
            }
        $query = $query . " image = '" . $image . "' ";
        }

        if($idAddress != null) {
            if ($flag) {
                $query = $query . ",";
            }
            $query = $query . ' id_address = ' . $idAddress . '';
        }

        $query = $query.' WHERE id_user_details =  ' . $id . '';

        $db->query($query);
    }

    public function getUserStats(int $idUser): ?UserStats
    {
        $db = $this->database->connect();

        $statement = $db->prepare('
        SELECT * FROM v_users_stats WHERE id_user = :id_user
        ');
        $statement->bindParam(':id_user', $idUser, PDO::PARAM_INT);
        $statement->execute();
        $stats = $statement->fetch(PDO::FETCH_ASSOC);

        if($stats == false)
        {
            //TODO optional exception
            return null;
        }

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
        $db = $this->database->connect();

        $statement = $db->prepare('
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
        $db = $this->database->connect();

        $statement = $db->prepare('
            INSERT INTO followers (id_requester, id_addressee)
            VALUES (?, ?)
        ');
        $statement->execute([
            $idFollower,
            $idFollowee
        ]);

        $this->updateFollowersAmount($idFollower, $idFollowee, 1);
    }

    public function unfollow(int $idFollower, int $idFollowee): void
    {
        $db = $this->database->connect();

        $statement = $db->prepare('
            DELETE FROM followers WHERE id_requester = :id_requester AND id_addressee = :id_addressee
        ');
        $statement->bindParam(':id_requester', $idFollower, PDO::PARAM_INT);
        $statement->bindParam(':id_addressee', $idFollowee, PDO::PARAM_INT);
        $statement->execute();

        $this->updateFollowersAmount($idFollower, $idFollowee, -1);
    }

    public function login(int $idUser): void
    {
        $this->log($idUser, true);

    }

    public function logout(int $idUser): void
    {
        $this->log($idUser, false);
    }

    public function log(int $idUser, bool $type): void{
        $db = $this->database->connect();
        $statement = $db->prepare('
            UPDATE users SET enabled = :type WHERE id_user = :idUser
        ');
        $statement->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $statement->bindParam(':type', $type, PDO::PARAM_BOOL);
        $statement->execute();
    }

    public function updateFollowersAmount(int $idFollower, int $idFollowee, $value): void
    {
        $db = $this->database->connect();

        $statement = $db->prepare('
            UPDATE users_details ud SET followers_amount = followers_amount + :value WHERE ud.id_user_details = (
            SELECT u.id_user_details FROM users u WHERE u.id_user = :id)
        ');
        $statement->bindParam(':id', $idFollowee, PDO::PARAM_INT);
        $statement->bindParam(':value', $value, PDO::PARAM_INT);
        $statement->execute();

        $statement = $db->prepare('
            UPDATE users_details ud SET following_amount = following_amount + :value WHERE ud.id_user_details = (
            SELECT u.id_user_details FROM users u WHERE u.id_user = :id)
        ');
        $statement->bindParam(':id', $idFollower, PDO::PARAM_INT);
        $statement->bindParam(':value', $value, PDO::PARAM_INT);
        $statement->execute();
    }
}