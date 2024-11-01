<?php
namespace FragosoSoftware\PagarmeSdk\Application\DTO;

class OrderDTO
{
    public $shipping;
    public $code;
    public $customerId;
    public $items;
    public $payments;
    public $closed;

    public function __construct(
        $code,
        $customerId,
        array $items,
        array $payments,
        ShippingDTO $shipping,
        $closed = true
    ) {
        $this->code = $code;
        $this->customerId = $customerId;
        $this->items = $items;
        $this->payments = $payments;
        $this->shipping = $shipping;
        $this->closed = $closed;
    }
}
