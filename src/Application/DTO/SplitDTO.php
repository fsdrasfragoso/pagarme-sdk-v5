<?php

namespace App\Application\DTO;

class SplitDTO
{
    public $amount;
    public $recipientId;
    public $type;
    public $options;

    public function __construct(
        int $amount,
        string $recipientId,
        string $type,
        SplitOptionsDTO $options
    ) {
        $this->amount = $amount;
        $this->recipientId = $recipientId;
        $this->type = $type;
        $this->options = $options;
    }
}
