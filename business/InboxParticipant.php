<?php
namespace business;
use DateTime;
class InboxParticipant
{
 private int $userId;
 private int $inboxId;
 private bool $deletedState;
 private int $unSeenMessages;
 private bool $isOpen;
 private DateTime $lastSent;
    /**
     * @param int $userId
     * @param int $inboxId
     * @param bool $deletedState
     * @param int $unSeenMessages
     * @param bool $isOpen
     * @param DateTime $lastSent
     */
    public function inboxParticipant(int $userId, int $inboxId, bool $deletedState, int $unSeenMessages, bool $isOpen, \DateTime $lastSent)
    {
        $this->userId = $userId;
        $this->inboxId = $inboxId;
        $this->deletedState = $deletedState;
        $this->unSeenMessages = $unSeenMessages;
        $this->isOpen = $isOpen;
        $this->lastSent = $lastSent;
    }

    public function __construct()
    {
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

    public function getLastSent(): DateTime
    {
        return $this->lastSent;
    }

    public function setLastSent(DateTime $lastSent): void
    {
        $this->lastSent = $lastSent;
    }


    public function __toString()
    {
        string: $data =  $this->userId . "" ;
        return $data;
    }


}