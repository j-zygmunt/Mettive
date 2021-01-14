<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Review.php';

class ReviewRepository extends Repository
{

    public function getReviews(string $userId): array
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM v_reviews WHERE id_reviewee = :userId
        ');
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->execute();
        $reviews = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach($reviews as $review)
        {
            $result[] = new Review(
                $review['rating'],
                $review['language'],
                $review['message'],
                $review['reviewed_at'],
                $review['reviewer_photo'],
                $review['reviewer_name'],
                $review['reviewer_surname']
            );
        }

        return $result;
    }

    public function addReview(Review $review, int $id, string $email): void
    {
        $statement = $this->database->connect()->prepare('
            //TODO
        ');
    }
}