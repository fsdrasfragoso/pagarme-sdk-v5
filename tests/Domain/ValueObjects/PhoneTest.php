<?php

namespace Tests\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;
use FragosoSoftware\PagarmeSdk\Domain\ValueObjects\Phone;
use FragosoSoftware\PagarmeSdk\Domain\ValueObjects\HomePhone;
use FragosoSoftware\PagarmeSdk\Domain\ValueObjects\MobilePhone;

class PhoneTest extends TestCase
{
    public function testPhoneCreation()
    {
        $homePhone = new HomePhone('55', '21', '12345678');
        $mobilePhone = new MobilePhone('55', '21', '987654321');
        
        $phone = new Phone($homePhone, $mobilePhone);

        $this->assertSame($homePhone, $phone->getHomePhone());
        $this->assertSame($mobilePhone, $phone->getMobilePhone());
    }
}
