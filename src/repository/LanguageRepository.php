<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Lang.php';

class LanguageRepository extends Repository
{

    public function addLanguage(Lang $lang)
    {
        $db = $this->database->connect();

        try{
            $statement = $db->prepare('
            INSERT INTO public.languages (language, number_of_users) VALUES (?, ?) ON CONFLICT (language) DO UPDATE SET number_of_users = languages.number_of_users + 1;
            ');
            $statement->execute([
               $lang->getName(),
               $lang->getNumberOfUsers()
            ]);
        }
        catch(PDOException $error){
            //TODO
        }
    }

    public function getLanguages(): array
    {
        $db = $this->database->connect();
        $result = [];

        $statement = $db->prepare('
            SELECT * FROM public.languages ORDER BY language
        ');
        $statement->execute();
        $languages = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($languages as $language)
        {
            $result[] = new Lang(
              $language['language'],
              $language['number_of_users']
            );
        }

        return $result;
    }

    public function getLanguage(string $languageName): ?Lang
    {
        $db = $this->database->connect();

        $statement = $db->prepare('
            SELECT * FROM public.languages WHERE language = :language
        ');
        $statement->bindParam(':language', $languageName, PDO::PARAM_STR);
        $statement->execute();

        $language = $statement->fetch(PDO::FETCH_ASSOC);

        if($language == false)
        {
            //TODO optional exception
            return null;
        }

        return new Lang(
            $language['language'],
            $language['number_of_users']
        );
    }
}