<?php
namespace FragosoSoftware\PagarmeSdk\Domain\Repositories;

interface RecipientRepositoryInterface
{
    /**
     * Cria um novo recebedor na API Pagar.me.
     *
     * @param array $recipientData
     * @return mixed
     */
    public function create(array $recipientData);

    /**
     * Atualiza as informações de um recebedor existente.
     *
     * @param string $recipientId
     * @param array $recipientData
     * @return mixed
     */
    public function update($recipientId, array $recipientData);

     /**
     * Cria um link de KYC para o recebedor.
     *
     * @param string $recipientId
     * @return mixed
     */
    public function createKycLink($recipientId);

      /**
     * Obtém os dados de um recebedor específico.
     *
     * @param string $recipientId
     * @return mixed
     */
    public function getRecipient($recipientId);

     /**
     * Lista todos os recebedores com suporte para paginação.
     *
     * @param int $page
     * @param int $size
     * @return mixed
     */
    public function listRecipients($page, $size);

    /**
     * Atualiza o código de um recebedor específico.
     *
     * @param string $recipientId
     * @param string $code
     * @return mixed
     */
    public function updateRecipientCode($recipientId, $code);


     /**
     * Obtém o saldo de um recebedor específico.
     *
     * @param string $recipientId
     * @return mixed
     */
    public function getBalance($recipientId);

    /**
     * Obtém o histórico das operações do saldo.
     *
     * @param array $filters
     * @return mixed
     */
    public function getBalanceOperations(array $filters = []);

    /**
     * Obtém uma operação específica de saldo.
     *
     * @param string $operationId
     * @return mixed
     */
    public function getBalanceOperation($operationId);
}
