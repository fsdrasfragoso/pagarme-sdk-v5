
<?php

namespace Tests\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;
use FragosoSoftware\PagarmeSdk\Domain\ValueObjects\Address;

class AddressTest extends TestCase
{
    public function testAddressCreation()
    {
        $address = new Address('BR', 'SP', 'São Paulo', '12345678', 'Avenida Paulista, 1000', 'Apto 202');

        $this->assertEquals('BR', $address->getCountry());
        $this->assertEquals('SP', $address->getState());
        $this->assertEquals('São Paulo', $address->getCity());
        $this->assertEquals('12345678', $address->getZipCode());
        $this->assertEquals('Avenida Paulista, 1000', $address->getLine1());
        $this->assertEquals('Apto 202', $address->getLine2());
    }
}
