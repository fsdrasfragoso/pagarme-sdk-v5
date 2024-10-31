<?php

namespace FragosoSoftware\PagarmeSdk\Application\DTO;

class PixPaymentDTO
{
    public $expiresIn;
    public $expiresAt;
    public $additionalInformation;

    public function __construct(int $expiresIn, string $expiresAt, array $additionalInformation)
    {
        $this->expiresIn = $expiresIn;
        $this->expiresAt = $expiresAt;
        $this->additionalInformation = $additionalInformation;
    }
}
