<?php

namespace FragosoSoftware\PagarmeSdk\Application\DTO;

class CreditCardPaymentDTO
{
    public $operationType;
    public $installments;
    public $statementDescriptor;
    public $cardId;

    public function __construct(
        string $operationType,
        int $installments,
        string $statementDescriptor,
        string $cardId
    ) {
        $this->operationType = $operationType;
        $this->installments = $installments;
        $this->statementDescriptor = $statementDescriptor;
        $this->cardId = $cardId;
    }
}
