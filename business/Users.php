<?php

class Users
{
    private int $id;
    private string $firstName;
    private  string $lastName;
    private DateTime $dateOfBirth;
    private string $email;
    private int $userType;
    private string $longitude;
    private string $latitude;
    private string $profilePic;
    private string $searchDiff;

    public function User():void{

}

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getDateOfBirth(): DateTime
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(DateTime $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getUserType(): int
    {
        return $this->userType;
    }

    public function setUserType(int $userType): void
    {
        $this->userType = $userType;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getProfilePic(): string
    {
        return $this->profilePic;
    }

    public function setProfilePic(string $profilePic): void
    {
        $this->profilePic = $profilePic;
    }

    public function getSearchDiff(): string
    {
        return $this->searchDiff;
    }

    public function setSearchDiff(string $searchDiff): void
    {
        $this->searchDiff = $searchDiff;
    }



}