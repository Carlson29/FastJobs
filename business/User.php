<?php
namespace business;
use DateTime;
//use business\Destination;
//require 'Destination.php';
class User
{
    private int $id;
    private string $name;
    private DateTime $dateOfBirth;
    private string $email;
    private string $password;
    private int $userType;
    private string $longitude;
    private string $latitude;
    private string $profilePic;
    private string $searchDiff;
    private DateTime $dateJoint;
    private ? Destination $destination;
    private DateTime $lastLogOut;

   public function __construct(){

}
    /**
     * @param int $id
     * @param string $name
     * @param DateTime $dateOfBirth
     * @param string $email
     * @param string $paswword
     * @param int $userType
     * @param string $longitude
     * @param string $latitude
     * @param string $profilePic
     * @param string $searchDiff
     * @param string $dateJoint
     */
    public function user(int $id, string $name, \DateTime $dateOfBirth, string $email, string $password, int $userType, string $longitude, string $latitude, string $profilePic, string $searchDiff, \DateTime $dateJoint, DateTime $lastLogOut)
    {
        $this->id = $id;
        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
        $this->email = $email;
        $this->password = $password;
        $this->userType = $userType;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->profilePic = $profilePic;
        $this->searchDiff = $searchDiff;
        $this->dateJoint=$dateJoint;
        $this->destination=null;
        $this->lastLogOut=$lastLogOut;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
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

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getLatitude(): ?string
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

    public function getDateJoint(): DateTime
    {
        return $this->dateJoint;
    }

    public function setDateJoint(DateTime $dateJoint): void
    {
        $this->dateJoint = $dateJoint;
    }

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(?Destination $destination): void
    {
        $this->destination = $destination;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getLastLogOut(): DateTime
    {
        return $this->lastLogOut;
    }

    public function setLastLogOut(DateTime $lastLogOut): void
    {
        $this->lastLogOut = $lastLogOut;
    }





    public function __toString()
    {
        string: $data =  $this->id . "" ;
        return $data;
    }


}