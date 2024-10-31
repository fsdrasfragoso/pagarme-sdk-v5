<?php

namespace App\Application\DTO;

class BoletoPaymentDTO
{
    public $interest;
    public $fine;
    public $instructions;
    public $dueAt;
    public $nossoNumero;

    public function __construct(
        InterestDTO $interest = null,
        FineDTO $fine = null,
        string $instructions,
        string $dueAt,
        string $nossoNumero
    ) {
        $this->interest = $interest;
        $this->fine = $fine;
        $this->instructions = $instructions;
        $this->dueAt = $dueAt;
        $this->nossoNumero = $nossoNumero;
    }
}
