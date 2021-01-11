<?php


class UserProfile
{
    private string $email;
    private string $photo;
    private string $name;
    private string $surname;
    private ?string $aboutMe;
    private ?int $followers_amount;
    private ?int $following_amount;
    private array $availableDates = [];

    public function __construct($email, $photo, $name, $surname, $about_me, $followers_amount, $following_amount)
    {
        $this->email = $email;
        $this->photo = $photo;
        $this->name = $name;
        $this->surname = $surname;
        $this->aboutMe = $about_me;
        $this->followers_amount = $followers_amount;
        $this->following_amount = $following_amount;
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

    public function getAboutMe(): ?string
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getFollowersAmount(): ?int
    {
        return $this->followers_amount;
    }

    public function setFollowersAmount($followers_amount)
    {
        $this->followers_amount = $followers_amount;
    }

    public function getFollowingAmount(): ?int
    {
        return $this->following_amount;
    }

    public function setFollowingAmount($following_amount)
    {
        $this->following_amount = $following_amount;
    }

}