<?php
namespace FragosoSoftware\PagarmeSdk\Application\DTO;

class HomePhoneDTO
{
    public $countryCode;
    public $areaCode;
    public $number;

    public function __construct($countryCode, $areaCode, $number)
    {
        $this->countryCode = $countryCode;
        $this->areaCode = $areaCode;
        $this->number = $number;
    }
}
