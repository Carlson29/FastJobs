<?php

class Message
{
    private int $messageId;
    private int $inboxId;
    private int $senderId;
    private string $message;
    private int $messageType;
    private DateTime $timeSent;
    private bool $deletedState;

    /**
     * @param int $messageId
     * @param int $inboxId
     * @param int $senderId
     * @param string $message
     * @param int $messageType
     * @param DateTime $timeSent
     * @param bool $deletedState
     */
    public function message(int $messageId, int $inboxId, int $senderId, string $message, int $messageType, DateTime $timeSent, bool $deletedState)
    {
        $this->messageId = $messageId;
        $this->inboxId = $inboxId;
        $this->senderId = $senderId;
        $this->message = $message;
        $this->messageType = $messageType;
        $this->timeSent = $timeSent;
        $this->deletedState = $deletedState;
    }

    public function __construct(){

    }


    public function getMessageId(): int
    {
        return $this->messageId;
    }

    public function setMessageId(int $messageId): void
    {
        $this->messageId = $messageId;
    }

    public function getInboxId(): int
    {
        return $this->inboxId;
    }

    public function setInboxId(int $inboxId): void
    {
        $this->inboxId = $inboxId;
    }

    public function getSenderId(): int
    {
        return $this->senderId;
    }

    public function setSenderId(int $senderId): void
    {
        $this->senderId = $senderId;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getMessageType(): int
    {
        return $this->messageType;
    }

    public function setMessageType(int $messageType): void
    {
        $this->messageType = $messageType;
    }

    public function getTimeSent(): DateTime
    {
        return $this->timeSent;
    }

    public function setTimeSent(DateTime $timeSent): void
    {
        $this->timeSent = $timeSent;
    }

    public function isDeletedState(): bool
    {
        return $this->deletedState;
    }

    public function setDeletedState(bool $deletedState): void
    {
        $this->deletedState = $deletedState;
    }



}