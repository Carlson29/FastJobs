<?php

class Review
{
    private int $reviewId;
    private int $userId;
    private string $review;
    private int $reviewerId;

    /**
     * @param int $reviewId
     * @param int $userId
     * @param string $review
     * @param int $reviewerId
     */
    public function review(int $reviewId, int $userId, string $review, int $reviewerId)
    {
        $this->reviewId = $reviewId;
        $this->userId = $userId;
        $this->review = $review;
        $this->reviewerId = $reviewerId;
    }
    public function __construct(){

    }


    public function getReviewId(): int
    {
        return $this->reviewId;
    }

    public function setReviewId(int $reviewId): void
    {
        $this->reviewId = $reviewId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getReview(): string
    {
        return $this->review;
    }

    public function setReview(string $review): void
    {
        $this->review = $review;
    }

    public function getReviewerId(): int
    {
        return $this->reviewerId;
    }

    public function setReviewerId(int $reviewerId): void
    {
        $this->reviewerId = $reviewerId;
    }



}