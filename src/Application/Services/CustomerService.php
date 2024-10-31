
<?php

namespace FragosoSoftware\PagarmeSdk\Application\Services;

use FragosoSoftware\PagarmeSdk\Application\DTO\CustomerDTO;
use FragosoSoftware\PagarmeSdk\Domain\Repositories\CustomerRepositoryInterface;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Converte CustomerDTO para array e cria um novo cliente.
     */
    public function createCustomer(CustomerDTO $customerData)
    {
        $customerArray = $this->convertToRepositoryArray($customerData);
        return $this->customerRepository->create($customerArray);
    }

    public function listCustomers(array $filters = [])
    {
        return $this->customerRepository->list($filters);
    }


    /**
     * Atualiza os dados do cliente.
     */
    public function updateCustomer($customerId, CustomerDTO $customerData)
    {
        $customerArray = $this->convertToRepositoryArray($customerData);
        return $this->customerRepository->update($customerId, $customerArray);
    }

    public function getCustomerById($customerId)
    {
        return $this->customerRepository->findById($customerId);
    }


    private function convertToRepositoryArray(CustomerDTO $customerData)
    {
        return [
            'name' => $customerData->name,
            'email' => $customerData->email,
            'code' => $customerData->code,
            'document' => $customerData->document,
            'document_type' => $customerData->documentType,
            'type' => $customerData->type,
            'gender' => $customerData->gender,
            'address' => [
                'country' => $customerData->address->country,
                'state' => $customerData->address->state,
                'city' => $customerData->address->city,
                'zip_code' => $customerData->address->zipCode,
                'line_1' => $customerData->address->line1,
                'line_2' => $customerData->address->line2,
            ],
            'phones' => [
                'home_phone' => [
                    'country_code' => $customerData->phones->homePhone->countryCode,
                    'area_code' => $customerData->phones->homePhone->areaCode,
                    'number' => $customerData->phones->homePhone->number,
                ],
                'mobile_phone' => [
                    'country_code' => $customerData->phones->mobilePhone->countryCode,
                    'area_code' => $customerData->phones->mobilePhone->areaCode,
                    'number' => $customerData->phones->mobilePhone->number,
                ]
            ]
        ];
    }
}

