<?php
namespace FragosoSoftware\PagarmeSdk\Application\DTO;

class MobilePhoneDTO extends HomePhoneDTO
{
    public function __construct($countryCode, $areaCode, $number)
    {
        parent::__construct($countryCode, $areaCode, $number);
    }
}
