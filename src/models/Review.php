<?php


class Review
{

    private int $rating;
    private string $reviewedLanguage;
    private string $message;
    private ?string $reviewedAt;
    private ?string $reviewerPhoto;
    private ?string $reviewerName;
    private ?string $reviewerSurname;

    public function __construct(
        int $rating,
        string $reviewedLanguage,
        string $message,
        ?string $reviewedAt,
        ?string $reviewerPhoto,
        ?string $reviewerName,
        ?string $reviewerSurname
    )
    {
        $this->rating = $rating;
        $this->reviewedLanguage = $reviewedLanguage;
        $this->message = $message;
        $this->reviewedAt = $reviewedAt;
        $this->reviewerPhoto = $reviewerPhoto;
        $this->reviewerName = $reviewerName;
        $this->reviewerSurname = $reviewerSurname;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function getReviewedLanguage(): string
    {
        return $this->reviewedLanguage;
    }

    public function setReviewedLanguage(string $reviewedLanguage): void
    {
        $this->reviewedLanguage = $reviewedLanguage;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getReviewedAt(): string
    {
        return $this->reviewedAt;
    }

    public function setReviewedAt(string $reviewedAt): void
    {
        $this->reviewedAt = $reviewedAt;
    }

    public function getReviewerPhoto(): string
    {
        return $this->reviewerPhoto;
    }

    public function setReviewerPhoto(string $reviewerPhoto): void
    {
        $this->reviewerPhoto = $reviewerPhoto;
    }

    public function getReviewerName(): string
    {
        return $this->reviewerName;
    }

    public function setReviewerName(string $reviewerName): void
    {
        $this->reviewerName = $reviewerName;
    }

    public function getReviewerSurname(): string
    {
        return $this->reviewerSurname;
    }

    public function setReviewerSurname(string $reviewerSurname): void
    {
        $this->reviewerSurname = $reviewerSurname;
    }




}