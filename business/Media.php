<?php
namespace business;
use DateTime;

class Media
{
    private int $postId;
    private string $media;
    private int $type;
    private DateTime $dateTime;
    /**
     * @param int $postId
     * @param string $media
     * @param int $type
     */
    public function media(int $postId, string $media, int $type, DateTime $dateTime)
    {
        $this->postId = $postId;
        $this->media = $media;
        $this->type = $type;
        $this->dateTime = $dateTime;
    }

    public function __construct()
    {

    }


    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    public function getMedia(): string
    {
        return $this->media;
    }

    public function setMedia(string $media): void
    {
        $this->media = $media;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    public function setDateTime(DateTime $dateTime): void
    {
        $this->dateTime = $dateTime;
    }



}