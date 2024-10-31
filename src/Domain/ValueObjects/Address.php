
<?php

namespace FragosoSoftware\PagarmeSdk\Domain\ValueObjects;

class Address
{
    private $country;
    private $state;
    private $city;
    private $zipCode;
    private $line1;
    private $line2;

    public function __construct($country, $state, $city, $zipCode, $line1, $line2)
    {
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
        $this->zipCode = $zipCode;
        $this->line1 = $line1;
        $this->line2 = $line2;
    }

    // Getters
    public function getCountry() { return $this->country; }
    public function getState() { return $this->state; }
    public function getCity() { return $this->city; }
    public function getZipCode() { return $this->zipCode; }
    public function getLine1() { return $this->line1; }
    public function getLine2() { return $this->line2; }
}
