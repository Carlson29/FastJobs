<?php

class Inbox
{
    private int $inboxId;
    private int $inboxType;
    private int $adminId;
    private string $groupName;

    /**
     * @param int $inboxId
     * @param int $inboxType
     * @param int $adminId
     * @param string $groupName
     */
    public function inbox(int $inboxId, int $inboxType, int $adminId, string $groupName)
    {
        $this->inboxId = $inboxId;
        $this->inboxType = $inboxType;
        $this->adminId = $adminId;
        $this->groupName = $groupName;
    }

  public function __construct(){

  }

    public function getInboxId(): int
    {
        return $this->inboxId;
    }

    public function setInboxId(int $inboxId): void
    {
        $this->inboxId = $inboxId;
    }

    public function getInboxType(): int
    {
        return $this->inboxType;
    }

    public function setInboxType(int $inboxType): void
    {
        $this->inboxType = $inboxType;
    }

    public function getAdminId(): int
    {
        return $this->adminId;
    }

    public function setAdminId(int $adminId): void
    {
        $this->adminId = $adminId;
    }

    public function getGroupName(): string
    {
        return $this->groupName;
    }

    public function setGroupName(string $groupName): void
    {
        $this->groupName = $groupName;
    }

    public function __toString()
    {
        string: $data =  $this->inboxId . "" ;
        return $data;
    }


}