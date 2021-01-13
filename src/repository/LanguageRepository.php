<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Lang.php';

class LanguageRepository extends Repository
{

    public function addLanguage(Lang $lang)
    {
        try{
            $statement = $this->database->connect()->prepare('
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
        $result = [];

        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.languages
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
        $statement = $this->database->connect()->prepare('
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