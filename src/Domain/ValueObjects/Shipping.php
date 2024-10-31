<?php

namespace FragosoSoftware\PagarmeSdk\Domain\ValueObjects;

class Shipping
{
    private $amount;
    private $description;
    private $recipientName;
    private $recipientPhone;
    private $address;

    public function __construct(
        int $amount,
        string $description,
        string $recipientName,
        string $recipientPhone,
        Address $address
    ) {
        $this->amount = $amount;
        $this->description = $description;
        $this->recipientName = $recipientName;
        $this->recipientPhone = $recipientPhone;
        $this->address = $address;
    }

    // Getters
    public function getAmount(): int { return $this->amount; }
    public function getDescription(): string { return $this->description; }
    public function getRecipientName(): string { return $this->recipientName; }
    public function getRecipientPhone(): string { return $this->recipientPhone; }
    public function getAddress(): Address { return $this->address; }
}
