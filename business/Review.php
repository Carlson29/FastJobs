<?php

class Review
{
    private int $reviewId;
    private int $userId;
    private string $review;
    private int $reviewerId;
    private DateTime $dateReviewed;
    /**
     * @param int $reviewId
     * @param int $userId
     * @param string $review
     * @param int $reviewerId
     */
    public function review(int $reviewId, int $userId, string $review, int $reviewerId, DateTime $dateReviewed)
    {
        $this->reviewId = $reviewId;
        $this->userId = $userId;
        $this->review = $review;
        $this->reviewerId = $reviewerId;
        $this->dateReviewed = $dateReviewed;
    }
    public function __construct(){

    }
    public function getDateReviewed(): DateTime
    {
        return $this->dateReviewed;
    }

    public function setDateReviewed(DateTime $dateReviewed): void
    {
        $this->dateReviewed = $dateReviewed;
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