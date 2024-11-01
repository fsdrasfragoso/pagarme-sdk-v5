<?php
namespace FragosoSoftware\PagarmeSdk\Application\DTO;

class FineDTO
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
