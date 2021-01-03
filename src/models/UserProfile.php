<?php


class UserProfile{
    private $email;
    private $photo;
    private $name;
    private $surname;
    private $aboutMe;
    private $availableDates = [];

    public function __construct($email, $photo, $name, $surname, $about_me)
    {
        $this->email = $email;
        $this->photo = $photo;
        $this->name = $name;
        $this->surname = $surname;
        $this->aboutMe = $about_me;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo)
    {
        $this->photo = $photo;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function getAboutMe(): string
    {
        return $this->aboutMe;
    }

    public function setAboutMe(string $aboutMe)
    {
        $this->aboutMe = $aboutMe;
    }

    public function addAvailableDate($availableDate)
    {
        $this->availableDates = $availableDate;
    }

    public function deleteAvailableDate($availableDate)
    {
        $this->availableDates = array_diff($this->availableDates, $availableDate);
    }

}