<?php

namespace App\Domain\ValueObjects;

class HomePhone
{
    private $countryCode;
    private $areaCode;
    private $number;

    public function __construct($countryCode, $areaCode, $number)
    {
        $this->countryCode = $countryCode;
        $this->areaCode = $areaCode;
        $this->number = $number;
    }

    // Getters
    public function getCountryCode() { return $this->countryCode; }
    public function getAreaCode() { return $this->areaCode; }
    public function getNumber() { return $this->number; }
}
