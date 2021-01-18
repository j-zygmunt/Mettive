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

    public function addReview(Review $review, int $idReviewer, int $idReviewee, string $email): void
    {
        $statement = $this->database->connect()->prepare('
            SELECT id_language FROM languages WHERE language = :language
        ');
        $lang = $review->getReviewedLanguage();
        $statement->bindParam(':language', $lang, PDO::PARAM_STR);
        $statement->execute();
        $langId = $statement->fetch(PDO::FETCH_ASSOC);

        $statement = $this->database->connect()->prepare('
            INSERT INTO public.users_reviews(rating, message, id_language, id_reviewer, id_reviewee)
            VALUES (?, ?, ?, ?, ?)
        ');
        $statement->execute([
            $review->getRating(),
            $review->getMessage(),
            $langId,
            $idReviewer,
            $idReviewee
        ]);
   }

   public function deleteReview(): void
   {
       $statement = $this->database->connect()->prepare('
            
       ');
   }
}