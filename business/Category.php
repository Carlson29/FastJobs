<?php
namespace business;
class Category
{
    private int $categoryId;
    private string $categoryName;
    private string $searchDiff;

    public function __construct()
    {

    }

    /**
     * @param int $categoryId
     * @param string $categoryName
     * @param string $searchDiff
     */
    public function category(int $categoryId, string $categoryName, string $searchDiff)
    {
        $this->categoryId = $categoryId;
        $this->categoryName = $categoryName;
        $this->searchDiff = $searchDiff;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    public function getSearchDiff(): string
    {
        return $this->searchDiff;
    }

    public function setSearchDiff(string $searchDiff): void
    {
        $this->searchDiff = $searchDiff;
    }

    public function __toString()
    {
        string: $data =  $this->categoryId . "" ;
        return $data;
    }

}