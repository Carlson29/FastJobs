<?php
namespace business;
class Destination
{
    private string $distance;
    private ? string $duration;
    private ? string $address;

    /**
     * @param string $distance
     * @param string $duration
     * @param string $address
     */
    public function Destination(string $distance,? string $duration, ? string $address)
    {
        $this->distance = $distance;
        $this->duration = $duration;
        $this->address = $address;
    }

    public function __construct()
    {
    }

    public function getDistance(): string
    {
        return $this->distance;
    }

    public function setDistance(string $distance): void
    {
        $this->distance = $distance;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): void
    {
        $this->duration = $duration;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function __toString():string
    {
       return $this->distance   . " - " . $this->duration  . " - " . $this->address ;
    }


}