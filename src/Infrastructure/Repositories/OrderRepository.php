<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\OrderRepositoryInterface;
use App\Infrastructure\Http\PagarmeApiClient;

class OrderRepository implements OrderRepositoryInterface
{
    protected $apiClient;

    public function __construct(PagarmeApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function create(array $orderData)
    {
        return $this->apiClient->post("orders", $orderData);
    }

    public function createMultiPayment(array $orderData)
    {
        return $this->apiClient->post("orders", $orderData);
    }

    public function createMultiBuyer(array $orderData)
    {
        return $this->apiClient->post("orders", $orderData);
    }

    public function addCharge(array $chargeData)
    {
        return $this->apiClient->post("charges", $chargeData);
    }

    public function findById(string $orderId)
    {
        return $this->apiClient->get("orders/{$orderId}");
    }

    public function close(string $orderId, array $statusData)
    {
        return $this->apiClient->patch("orders/{$orderId}/closed", $statusData);
    }

    public function list(array $filters = [])
    {
        return $this->apiClient->get("orders", $filters);
    }
}
