<?php


class Lang
{
    private string $name;
    private int $numberOfUsers;

    public function __construct(string $name, int $numberOfUsers = 0)
    {
        $this->name = $name;
        $this->numberOfUsers = $numberOfUsers;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getNumberOfUsers(): int
    {
        return $this->numberOfUsers;
    }

    public function setNumberOfUsers(int $numberOfUsers): void
    {
        $this->numberOfUsers = $numberOfUsers;
    }

}