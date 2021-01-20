<?php


class Address
{
    private string $country;
    private string $city;
    private ?int $id;

    public function __construct(string $country, string $city, ?int $id)
    {
        $this->country = $country;
        $this->city = $city;
        $this->id = $id;
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}