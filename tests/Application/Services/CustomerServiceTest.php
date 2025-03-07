<?php

namespace Tests\Application\Services;

use PHPUnit\Framework\TestCase;
use FragosoSoftware\PagarmeSdk\Application\Services\CustomerService;
use FragosoSoftware\PagarmeSdk\Domain\Repositories\CustomerRepositoryInterface;
use FragosoSoftware\PagarmeSdk\Application\DTO\CustomerDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\AddressDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\PhoneDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\HomePhoneDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\MobilePhoneDTO;

class CustomerServiceTest extends TestCase
{
    private $customerService;
    private $customerRepository;

    protected function setUp(): void
    {
        // Mocking CustomerRepositoryInterface
        $this->customerRepository = $this->createMock(CustomerRepositoryInterface::class);
        $this->customerService = new CustomerService($this->customerRepository);
    }

    public function testCreateCustomer()
    {
        // Dados fictícios para o DTO
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

        // Definir comportamento esperado do mock do repositório
        $this->customerRepository->expects($this->once())
            ->method('create')
            ->with($customerDTO)
            ->willReturn(['id' => 'cust_12345', 'name' => 'João Silva']);

        $response = $this->customerService->createCustomer($customerDTO);

        $this->assertEquals('cust_12345', $response['id']);
        $this->assertEquals('João Silva', $response['name']);
    }

    public function testGetCustomerById()
    {
        $customerId = 'cust_12345';

        $this->customerRepository->expects($this->once())
            ->method('findById')
            ->with($customerId)
            ->willReturn(['id' => $customerId, 'name' => 'João Silva']);

        $response = $this->customerService->getCustomerById($customerId);

        $this->assertEquals('cust_12345', $response['id']);
        $this->assertEquals('João Silva', $response['name']);
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

        $this->customerRepository->expects($this->once())
            ->method('update')
            ->with($customerId, $customerDTO)
            ->willReturn(['id' => $customerId, 'name' => 'João Silva', 'email' => 'joao.silva@example.com']);

        $response = $this->customerService->updateCustomer($customerId, $customerDTO);

        $this->assertEquals('cust_12345', $response['id']);
        $this->assertEquals('João Silva', $response['name']);
        $this->assertEquals('joao.silva@example.com', $response['email']);
    }
}
