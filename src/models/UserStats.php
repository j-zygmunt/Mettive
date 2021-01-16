<?php


class UserStats
{
    private int $AVGRating;
    private int $followersAmount;
    private int $followingAmount;
    private int $reviewsAmount;
    private string $createdAt;


    public function __construct(int $AVGRating, int $followersAmount, int $followingAmount, int $reviewsAmount, string $createdAt)
    {
        $this->AVGRating = $AVGRating;
        $this->followersAmount = $followersAmount;
        $this->followingAmount = $followingAmount;
        $this->reviewsAmount = $reviewsAmount;
        $this->createdAt = $createdAt;
    }

    public function getAVGRating(): int
    {
        return $this->AVGRating;
    }

    public function setAVGRating(int $AVGRating): void
    {
        $this->AVGRating = $AVGRating;
    }

    public function getFollowersAmount(): int
    {
        return $this->followersAmount;
    }

    public function setFollowersAmount(int $followersAmount): void
    {
        $this->followersAmount = $followersAmount;
    }

    public function getFollowingAmount(): int
    {
        return $this->followingAmount;
    }

    public function setFollowingAmount(int $followingAmount): void
    {
        $this->followingAmount = $followingAmount;
    }

    public function getReviewsAmount(): int
    {
        return $this->reviewsAmount;
    }

    public function setReviewsAmount(int $reviewsAmount): void
    {
        $this->reviewsAmount = $reviewsAmount;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}