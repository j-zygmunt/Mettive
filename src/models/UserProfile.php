<?php


class UserProfile
{
    private string $email;
    private string $photo;
    private string $name;
    private string $surname;
    private string $mainLanguage;
    private ?string $aboutMe;
    private ?string $country;
    private ?string $city;
    private ?bool $isFriend;
    private ?int $id;

    public function __construct(
        string $email,
        string $photo,
        string $name,
        string $surname,
        ?string $aboutMe,
        string $mainLanguage,
        ?string $country,
        ?string $city,
        ?int $id,
        ?bool $isFriend = false
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->photo = $photo;
        $this->name = $name;
        $this->surname = $surname;
        $this->aboutMe = $aboutMe;
        $this->mainLanguage = $mainLanguage;
        $this->country = $country;
        $this->city = $city;
        $this->isFriend= $isFriend ?? 0;
    }

    public function getIsFriend(): int
    {
        return $this->isFriend;
    }

    public function setIsFriend($isFriend): void
    {
        $this->isFriend = $isFriend;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
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

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

}