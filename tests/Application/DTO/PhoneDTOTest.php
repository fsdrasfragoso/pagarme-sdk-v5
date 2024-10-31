
<?php

namespace Tests\Application\DTO;

use PHPUnit\Framework\TestCase;
use App\Application\DTO\PhoneDTO;
use App\Application\DTO\HomePhoneDTO;
use App\Application\DTO\MobilePhoneDTO;

class PhoneDTOTest extends TestCase
{
    public function testPhoneDTOCreation()
    {
        $homePhone = new HomePhoneDTO('55', '21', '12345678');
        $mobilePhone = new MobilePhoneDTO('55', '21', '987654321');
        
        $phoneDTO = new PhoneDTO($homePhone, $mobilePhone);

        $this->assertSame($homePhone, $phoneDTO->homePhone);
        $this->assertSame($mobilePhone, $phoneDTO->mobilePhone);
    }
}
