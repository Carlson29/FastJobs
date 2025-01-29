<?php

class Media
{
    private int $postId;
    private string $media;
    private int $type;

    /**
     * @param int $postId
     * @param string $media
     * @param int $type
     */
    public function media(int $postId, string $media, int $type)
    {
        $this->postId = $postId;
        $this->media = $media;
        $this->type = $type;
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


}