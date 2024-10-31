
<?php

namespace Tests\Application\DTO;

use PHPUnit\Framework\TestCase;
use FragosoSoftware\PagarmeSdk\Application\DTO\PhoneDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\HomePhoneDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\MobilePhoneDTO;

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
