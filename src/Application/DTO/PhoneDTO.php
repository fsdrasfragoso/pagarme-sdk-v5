<?php
namespace FragosoSoftware\PagarmeSdk\Application\DTO;

use FragosoSoftware\PagarmeSdk\Application\DTO\HomePhoneDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\MobilePhoneDTO;

class PhoneDTO
{
    public $homePhone;
    public $mobilePhone;

    public function __construct(HomePhoneDTO $homePhone = null, MobilePhoneDTO $mobilePhone = null)
    {
        $this->homePhone = $homePhone;
        $this->mobilePhone = $mobilePhone;
    }
}
