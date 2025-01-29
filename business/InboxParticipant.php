<?php

class InboxParticipant
{
 private int $userId;
 private int $inboxId;
 private bool $deletedState;
 private int $unSeenMessages;
 private bool $isOpen;

    /**
     * @param int $userId
     * @param int $inboxId
     * @param bool $deletedState
     * @param int $unSeenMessages
     * @param bool $isOpen
     */
    public function inboxParticipant(int $userId, int $inboxId, bool $deletedState, int $unSeenMessages, bool $isOpen)
    {
        $this->userId = $userId;
        $this->inboxId = $inboxId;
        $this->deletedState = $deletedState;
        $this->unSeenMessages = $unSeenMessages;
        $this->isOpen = $isOpen;
    }


    private function __construct(){

    }
    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getInboxId(): int
    {
        return $this->inboxId;
    }

    public function setInboxId(int $inboxId): void
    {
        $this->inboxId = $inboxId;
    }

    public function isDeletedState(): bool
    {
        return $this->deletedState;
    }

    public function setDeletedState(bool $deletedState): void
    {
        $this->deletedState = $deletedState;
    }

    public function getUnSeenMessages(): int
    {
        return $this->unSeenMessages;
    }

    public function setUnSeenMessages(int $unSeenMessages): void
    {
        $this->unSeenMessages = $unSeenMessages;
    }

    public function isOpen(): bool
    {
        return $this->isOpen;
    }

    public function setIsOpen(bool $isOpen): void
    {
        $this->isOpen = $isOpen;
    }


}