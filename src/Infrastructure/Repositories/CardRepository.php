
<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\CardRepositoryInterface;
use App\Infrastructure\Http\PagarmeApiClient;
use App\Application\DTO\CardDTO;

class CardRepository implements CardRepositoryInterface
{
    protected $apiClient;

    public function __construct(PagarmeApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function create($customerId, array $cardData)
    {
        return $this->apiClient->post("customers/{$customerId}/cards", $cardData);
    }

    public function getById($customerId, $cardId)
    {
        return $this->apiClient->get("customers/{$customerId}/cards/{$cardId}");
    }

    public function list($customerId)
    {
        return $this->apiClient->get("customers/{$customerId}/cards");
    }

    public function update($customerId, $cardId, array $data)
    {
        return $this->apiClient->put("customers/{$customerId}/cards/{$cardId}", $data);
    }

    public function delete($customerId, $cardId)
    {
        return $this->apiClient->delete("customers/{$customerId}/cards/{$cardId}");
    }

    public function renew($customerId, $cardId)
    {
        return $this->apiClient->post("customers/{$customerId}/cards/{$cardId}/renew", []);
    }
}