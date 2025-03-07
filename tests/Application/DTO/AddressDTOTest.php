<?php

namespace Tests\Application\DTO;

use PHPUnit\Framework\TestCase;
use FragosoSoftware\PagarmeSdk\Application\DTO\AddressDTO;

class AddressDTOTest extends TestCase
{
    public function testAddressDTOCreation()
    {
        $addressDTO = new AddressDTO(
            'BR',
            'SP',
            'São Paulo',
            '12345678',
            'Avenida Paulista, 1000',
            'Apto 202'
        );

        $this->assertEquals('BR', $addressDTO->country);
        $this->assertEquals('SP', $addressDTO->state);
        $this->assertEquals('São Paulo', $addressDTO->city);
        $this->assertEquals('12345678', $addressDTO->zipCode);
        $this->assertEquals('Avenida Paulista, 1000', $addressDTO->line1);
        $this->assertEquals('Apto 202', $addressDTO->line2);
    }
}
