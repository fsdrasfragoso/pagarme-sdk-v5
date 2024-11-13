<?php
namespace FragosoSoftware\PagarmeSdk\Infrastructure\Repositories;

use FragosoSoftware\PagarmeSdk\Domain\Repositories\RecipientRepositoryInterface;
use FragosoSoftware\PagarmeSdk\Infrastructure\Http\PagarmeApiClient;

class RecipientRepository implements RecipientRepositoryInterface
{
    protected $apiClient;

    public function __construct(PagarmeApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Cria um novo recebedor na API Pagar.me.
     *
     * @param array $recipientData
     * @return mixed
     */
    public function create(array $recipientData)
    {
        return $this->apiClient->post('recipients', $recipientData);
    }

    /**
     * Atualiza as informações de um recebedor existente.
     *
     * @param string $recipientId
     * @param array $recipientData
     * @return mixed
     */
    public function update($recipientId, array $recipientData)
    {
        return $this->apiClient->put("recipients/{$recipientId}", $recipientData);
    }


    public function createKycLink($recipientId)
    {
        return $this->apiClient->post("recipients/{$recipientId}/kyc_link",[]);
    }

    public function getRecipient($recipientId)
    {
        return $this->apiClient->get("recipients/{$recipientId}");
    }

    public function listRecipients($page = 1, $size = 10)
    {
        return $this->apiClient->get("recipients", [
            'page' => $page,
            'size' => $size
        ]);
    }

    public function updateRecipientCode($recipientId, $code)
    {
        return $this->apiClient->patch("recipients/{$recipientId}/code", [
            'code' => $code
        ]);
    }

    public function getBalance($recipientId)
    {
        return $this->apiClient->get("recipients/{$recipientId}/balance");
    }

    public function getBalanceOperations(array $filters = [])
    {
        return $this->apiClient->get('balance/operations', $filters);
    }

    public function getBalanceOperation($operationId)
    {
        return $this->apiClient->get("balance/operations/{$operationId}");
    }



}
