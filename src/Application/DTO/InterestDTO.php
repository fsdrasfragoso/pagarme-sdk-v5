<?php

namespace App\Application\DTO;

class InterestDTO
{
    public $days;
    public $type;
    public $amount;

    public function __construct(int $days, string $type, float $amount)
    {
        $this->days = $days;
        $this->type = $type;
        $this->amount = $amount;
    }
}