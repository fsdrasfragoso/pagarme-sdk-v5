<?php
namespace FragosoSoftware\PagarmeSdk\Interfaces\Http\Controllers;

use FragosoSoftware\PagarmeSdk\Application\Services\CustomerService;
use FragosoSoftware\PagarmeSdk\Application\DTO\CustomerDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\AddressDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\PhoneDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomerController
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Cria um novo cliente.
     */
    public function create(Request $request)
    {
        $data = $request->request->all();

        $address = new AddressDTO(
            $data['country'],
            $data['state'],
            $data['city'],
            $data['zipCode'],
            $data['line1'],
            $data['line2'] ?? null
        );

        $phone = new PhoneDTO(
            $data['phoneCountryCode'],
            $data['phoneAreaCode'],
            $data['phoneNumber']
        );

        $customerDTO = new CustomerDTO(
            $data['name'],
            $data['email'],
            $data['code'] ?? null,
            $data['document'],
            $data['documentType'],
            $data['type'],
            $data['gender'] ?? null,
            $address,
            $phone
        );

        try {
            $response = $this->customerService->createCustomer($customerDTO);
            return new JsonResponse(['status' => 'success', 'data' => $response], 201);
        } catch (\Exception $e) {
            return new JsonResponse(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    /**
     * Retorna um cliente pelo ID.
     */
    public function getCustomerById($customerId)
    {
        try {
            $response = $this->customerService->getCustomerById($customerId);
            return new JsonResponse(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $e) {
            return new JsonResponse(['status' => 'error', 'message' => $e->getMessage()], 404);
        }
    }

    /**
     * Atualiza um cliente existente.
     */
    public function update(Request $request, $customerId)
    {
        $data = $request->request->all();

        $address = new AddressDTO(
            $data['country'],
            $data['state'],
            $data['city'],
            $data['zipCode'],
            $data['line1'],
            $data['line2'] ?? null
        );

        $phone = new PhoneDTO(
            $data['phoneCountryCode'],
            $data['phoneAreaCode'],
            $data['phoneNumber']
        );

        $customerDTO = new CustomerDTO(
            $data['name'],
            $data['email'],
            $data['code'] ?? null,
            $data['document'],
            $data['documentType'],
            $data['type'],
            $data['gender'] ?? null,
            $address,
            $phone
        );

        try {
            $response = $this->customerService->updateCustomer($customerId, $customerDTO);
            return new JsonResponse(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $e) {
            return new JsonResponse(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
