<?php

namespace Tests\Infrastructure\Repositories;

use PHPUnit\Framework\TestCase;
use FragosoSoftware\PagarmeSdk\Infrastructure\Repositories\CustomerRepository;
use FragosoSoftware\PagarmeSdk\Infrastructure\Http\PagarmeApiClient;
use FragosoSoftware\PagarmeSdk\Application\DTO\CustomerDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\AddressDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\PhoneDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\HomePhoneDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\MobilePhoneDTO;

class CustomerRepositoryTest extends TestCase
{
    private $customerRepository;
    private $apiClientMock;

    protected function setUp(): void
    {
        $this->apiClientMock = $this->createMock(PagarmeApiClient::class);
        $this->customerRepository = new CustomerRepository($this->apiClientMock);
    }

    public function testCreateCustomer()
    {
        $address = new AddressDTO('BR', 'SP', 'São Paulo', '12345678', 'Rua Fictícia, 100', 'Apto 202');
        $homePhone = new HomePhoneDTO('55', '11', '12345678');
        $mobilePhone = new MobilePhoneDTO('55', '11', '987654321');
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

        $expectedResponse = ['id' => 'cust_12345', 'name' => 'João Silva'];
        
        $this->apiClientMock->expects($this->once())
            ->method('post')
            ->with('customers', $this->anything())
            ->willReturn($expectedResponse);

        $response = $this->customerRepository->create($customerDTO);

        $this->assertEquals($expectedResponse, $response);
    }

    public function testFindCustomerById()
    {
        $customerId = 'cust_12345';
        $expectedResponse = ['id' => $customerId, 'name' => 'João Silva'];

        $this->apiClientMock->expects($this->once())
            ->method('get')
            ->with("customers/{$customerId}")
            ->willReturn($expectedResponse);

        $response = $this->customerRepository->findById($customerId);

        $this->assertEquals($expectedResponse, $response);
    }

    public function testUpdateCustomer()
    {
        $customerId = 'cust_12345';
        $address = new AddressDTO('BR', 'SP', 'São Paulo', '12345678', 'Rua Fictícia, 100', 'Apto 202');
        $homePhone = new HomePhoneDTO('55', '11', '12345678');
        $mobilePhone = new MobilePhoneDTO('55', '11', '987654321');
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

        $expectedResponse = [
            'id' => $customerId,
            'name' => 'João Silva',
            'email' => 'joao.silva@example.com'
        ];

        $this->apiClientMock->expects($this->once())
            ->method('post')
            ->with("customers/{$customerId}", $this->anything())
            ->willReturn($expectedResponse);

        $response = $this->customerRepository->update($customerId, $customerDTO);

        $this->assertEquals($expectedResponse, $response);
    }
}
