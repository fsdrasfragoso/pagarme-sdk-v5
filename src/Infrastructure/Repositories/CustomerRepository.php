
<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\CustomerRepositoryInterface;
use App\Infrastructure\Http\PagarmeApiClient;

class CustomerRepository implements CustomerRepositoryInterface
{
    protected $apiClient;

    public function __construct(PagarmeApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function create(array $customerData)
    {
        return $this->apiClient->post('customers', $customerData);
    }

    public function findById($customerId)
    {
        return $this->apiClient->get("customers/{$customerId}");
    }

    public function update($customerId, array $customerData)
    {
        return $this->apiClient->put("customers/{$customerId}", $customerData);
    }

    public function list(array $filters = [])
    {
        return $this->apiClient->get('customers', $filters);
    }

}

