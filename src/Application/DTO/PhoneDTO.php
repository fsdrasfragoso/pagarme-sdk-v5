<?php
namespace App\Application\DTO;

use App\Application\DTO\HomePhoneDTO;
use App\Application\DTO\MobilePhoneDTO;

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
