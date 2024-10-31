<?php
namespace App\Application\DTO;

class AddressDTO
{
    public $country;
    public $state;
    public $city;
    public $zipCode;
    public $line1;
    public $line2;

    public function __construct($country, $state, $city, $zipCode, $line1, $line2)
    {
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
        $this->zipCode = $zipCode;
        $this->line1 = $line1;
        $this->line2 = $line2;
    }
}
