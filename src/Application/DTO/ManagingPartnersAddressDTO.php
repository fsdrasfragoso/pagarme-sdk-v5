<?php
namespace FragosoSoftware\PagarmeSdk\Application\DTO;

class ManagingPartnersAddressDTO
{
    public $street;
    public $complementary;
    public $streetNumber;
    public $neighborhood;
    public $city;
    public $state;
    public $zipCode;
    public $referencePoint;

    public function __construct(
        $street,
        $complementary,
        $streetNumber,
        $neighborhood,
        $city,
        $state,
        $zipCode,
        $referencePoint = null
    ) {
        $this->street = $street;
        $this->complementary = $complementary;
        $this->streetNumber = $streetNumber;
        $this->neighborhood = $neighborhood;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->referencePoint = $referencePoint;
    }
}
