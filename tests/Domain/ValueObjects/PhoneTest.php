
<?php

namespace Tests\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObjects\Phone;
use App\Domain\ValueObjects\HomePhone;
use App\Domain\ValueObjects\MobilePhone;

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
