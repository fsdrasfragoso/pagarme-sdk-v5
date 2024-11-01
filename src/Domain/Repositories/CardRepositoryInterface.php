<?php
namespace FragosoSoftware\PagarmeSdk\Domain\Repositories;

interface CardRepositoryInterface
{
    public function create($customerId, array $cardData);
    public function getById($customerId, $cardId);
    public function list($customerId);
    public function update($customerId, $cardId, array $data);
    public function delete($customerId, $cardId);
    public function renew($customerId, $cardId);
}
