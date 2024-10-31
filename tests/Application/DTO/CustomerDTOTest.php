<?php

namespace Tests\Application\DTO;

use PHPUnit\Framework\TestCase;
use App\Application\DTO\CustomerDTO;
use App\Application\DTO\AddressDTO;
use App\Application\DTO\PhoneDTO;
use App\Application\DTO\HomePhoneDTO;
use App\Application\DTO\MobilePhoneDTO;

class CustomerDTOTest extends TestCase
{
    public function testCustomerDTOCreation()
    {
        $address = new AddressDTO('BR', 'RJ', 'Rio de Janeiro', '12345678', 'Rua Fictícia, 100', 'Apto 202');
        $homePhone = new HomePhoneDTO('55', '21', '12345678');
        $mobilePhone = new MobilePhoneDTO('55', '21', '987654321');
        $phone = new PhoneDTO($homePhone, $mobilePhone);

        $customerDTO = new CustomerDTO(
            'João Silva',
            'joao.silva@example.com',
            '123',
            '12345678900',
            'CPF',
            'individual',
            'male',
            $address,
            $phone
        );

        $this->assertEquals('João Silva', $customerDTO->name);
        $this->assertEquals('joao.silva@example.com', $customerDTO->email);
        $this->assertEquals('123', $customerDTO->code);
        $this->assertEquals('12345678900', $customerDTO->document);
        $this->assertEquals('CPF', $customerDTO->documentType);
        $this->assertEquals('individual', $customerDTO->type);
        $this->assertEquals('male', $customerDTO->gender);
        $this->assertSame($address, $customerDTO->address);
        $this->assertSame($phone, $customerDTO->phones);
    }
}
