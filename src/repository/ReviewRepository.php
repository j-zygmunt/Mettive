<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Review.php';

class ReviewRepository extends Repository
{

    public function getReviews(string $userId): array
    {
        $db = $this->database->connect();

        $statement = $db->prepare('
            SELECT * FROM v_reviews WHERE id_reviewee = :userId ORDER BY reviewed_at DESC
        ');
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->execute();
        $reviews = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach($reviews as $review)
        {
            $result[] = new Review(
                $review['rating'],
                $review['message'],
                $review['id_review'],
                $review['reviewed_at'],
                $review['reviewer_photo'],
                $review['reviewer_name'],
                $review['reviewer_surname']
            );
        }

        return $result;
    }

    public function addReview(Review $review, int $idReviewer, int $idReviewee): void
    {
        $db = $this->database->connect();

        $statement = $db->prepare('
            INSERT INTO public.users_reviews(rating, message, id_reviewer, id_reviewee)
            VALUES (?, ?, ?, ?)
        ');
        $statement->execute([
            $review->getRating(),
            $review->getMessage(),
            $idReviewer,
            $idReviewee
        ]);
   }

   public function deleteReview(int $idReview): void
   {
       $db = $this->database->connect();

       $statement = $db->prepare('
            DELETE FROM users_reviews WHERE id_review = :idReview
       ');
       $statement->bindParam(':idReview', $idReview, PDO::PARAM_INT);
       $statement->execute();
   }
}