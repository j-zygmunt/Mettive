<?php

require_once __DIR__.'/../models/Review.php';
require_once __DIR__.'/../repository/ReviewRepository.php';

class ReviewController extends AppController
{
    private ReviewRepository $reviewRepository;

    public function __construct()
    {
        parent::__construct();
        $this->reviewRepository = new ReviewRepository();
    }

    function addReview(): void
    {
        $this->checkCookie();
        $idUser = intval($_COOKIE["user"]);
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : "";

        if($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            $review = new Review($decoded['rating'], $decoded['message'], null, null, null, null, null);
            $this->reviewRepository->addReview($review, $idUser, $decoded['idReviewee']);

            http_response_code(200);
        }
    }

    function deleteReview($idReview): void
    {
        $this->checkCookie();

        if(intval($_COOKIE['role']) != 2)
            return;

        $this->reviewRepository->deleteReview($idReview);
        http_response_code(200);
    }
}