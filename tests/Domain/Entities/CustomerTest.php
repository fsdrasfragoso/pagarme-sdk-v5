<?php

namespace Tests\Domain\Entities;

use PHPUnit\Framework\TestCase;
use FragosoSoftware\PagarmeSdk\Domain\Entities\Customer;
use FragosoSoftware\PagarmeSdk\Domain\ValueObjects\Address;
use FragosoSoftware\PagarmeSdk\Domain\ValueObjects\Phone;
use FragosoSoftware\PagarmeSdk\Domain\ValueObjects\HomePhone;
use FragosoSoftware\PagarmeSdk\Domain\ValueObjects\MobilePhone;

class CustomerTest extends TestCase
{
    public function testCustomerEntityCreation()
    {
        $address = new Address('BR', 'SP', 'São Paulo', '12345678', 'Rua Fictícia, 100', 'Apto 202');
        $homePhone = new HomePhone('55', '11', '12345678');
        $mobilePhone = new MobilePhone('55', '11', '987654321');
        $phone = new Phone($homePhone, $mobilePhone);

        $customer = new Customer(
            'cust_12345',
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

        $this->assertEquals('cust_12345', $customer->getId());
        $this->assertEquals('João Silva', $customer->getName());
        $this->assertEquals('joao.silva@example.com', $customer->getEmail());
        $this->assertEquals('123', $customer->getCode());
        $this->assertEquals('12345678900', $customer->getDocument());
        $this->assertEquals('CPF', $customer->getDocumentType());
        $this->assertEquals('individual', $customer->getType());
        $this->assertEquals('male', $customer->getGender());
        $this->assertSame($address, $customer->getAddress());
        $this->assertSame($phone, $customer->getPhones());
    }
}
