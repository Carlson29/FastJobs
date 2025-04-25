<?php

namespace business;
class UsersCategory
{
    private int $categoryId;
    private int $userId;

    /**
     * @param int $categoryId
     * @param int $userId
     */
    public function __construct()
    {

    }

    public function usersCategory(int $categoryId, int $userId)
    {
        $this->categoryId = $categoryId;
        $this->userId = $userId;
    }


    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }


}