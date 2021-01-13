<?php


class UserProfile
{
    private string $photo;
    private string $name;
    private string $surname;
    private ?string $aboutMe;
    private ?string $mainLanguage;
    private ?int $followers_amount;
    private ?int $following_amount;
    private ?string $country;
    private ?string $city;

    public function __construct(
        string $photo,
        string $name,
        string $surname,
        ?string $mainLanguage,
        ?string $about_me,
        string $country = "country",
        string $city = "city",
        int $followers_amount = 0,
        int $following_amount = 0
    )
    {
        $this->photo = $photo;
        $this->name = $name;
        $this->surname = $surname;
        $this->aboutMe = $about_me;
        $this->mainLanguage = $mainLanguage;
        $this->country = $country;
        $this->city = $city;
        $this->followers_amount = $followers_amount;
        $this->following_amount = $following_amount;
    }

    public function getMainLanguage(): string
    {
        return $this->mainLanguage;
    }

    public function setMainLanguage(string $mainLanguage): void
    {
        $this->mainLanguage = $mainLanguage;
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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

}