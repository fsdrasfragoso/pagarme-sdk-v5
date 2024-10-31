<?php

namespace FragosoSoftware\PagarmeSdk\Application\Services;

use FragosoSoftware\PagarmeSdk\Application\DTO\CardDTO;
use FragosoSoftware\PagarmeSdk\Domain\Repositories\CardRepositoryInterface;

class CardService
{
    protected $cardRepository;

    public function __construct(CardRepositoryInterface $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }

    public function createCard($customerId, CardDTO $cardData)
    {
        return $this->cardRepository->create($customerId, $this->convertToRepositoryArray($cardData));
    }

    public function getCard($customerId, $cardId)
    {
        return $this->cardRepository->getById($customerId, $cardId);
    }

    public function listCards($customerId)
    {
        return $this->cardRepository->list($customerId);
    }

    public function updateCard($customerId, $cardId, CardDTO $cardData)
    {
        return $this->cardRepository->update($customerId, $cardId, $this->convertToRepositoryArray($cardData));
    }

    public function deleteCard($customerId, $cardId)
    {
        return $this->cardRepository->delete($customerId, $cardId);
    }

    public function renewCard($customerId, $cardId)
    {
        return $this->cardRepository->renew($customerId, $cardId);
    }


    private function convertToRepositoryArray(CardDTO $cardData)
    {
        return [
            'billing_address' => [
                'line_1' => $cardData->billingAddress->line1,
                'line_2' => $cardData->billingAddress->line2,
                'zip_code' => $cardData->billingAddress->zipCode,
                'city' => $cardData->billingAddress->city,
                'state' => $cardData->billingAddress->state,
                'country' => $cardData->billingAddress->country,
            ],
            'number' => $cardData->number,
            'holder_name' => $cardData->holderName,
            'holder_document' => $cardData->holderDocument,
            'exp_month' => $cardData->expMonth,
            'exp_year' => $cardData->expYear,
            'cvv' => $cardData->cvv,
        ];
    }
}
