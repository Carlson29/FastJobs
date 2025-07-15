<?php
namespace business;
use DateTime;

class Post
{
    private int $postId;
    private int $userId;
    private DateTime $dateTime;
    private int $type;
    private int $userType;

    /**
     * @param int $postId
     * @param int $userId
     * @param DateTime $dateTime
     * @param int $type
     * @param int $userType
     */
    public function post(int $postId, int $userId, DateTime $dateTime, int $type, int $userType)
    {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->dateTime = $dateTime;
        $this->type = $type;
        $this->userType = $userType;
    }
    public function __construct(){

    }


    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    public function setDateTime(DateTime $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function getUserType(): int
    {
        return $this->userType;
    }

    public function setUserType(int $userType): void
    {
        $this->userType = $userType;
    }



}