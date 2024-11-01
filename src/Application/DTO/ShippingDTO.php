<?php
namespace FragosoSoftware\PagarmeSdk\Application\DTO;

class ShippingDTO
{
    public $amount;
    public $description;
    public $recipientName;
    public $recipientPhone;
    public $address;

    public function __construct($amount, $description, $recipientName, $recipientPhone, AddressDTO $address)
    {
        $this->amount = $amount;
        $this->description = $description;
        $this->recipientName = $recipientName;
        $this->recipientPhone = $recipientPhone;
        $this->address = $address;
    }
}
