
<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Shipping;
use App\Domain\ValueObjects\Item;
use App\Domain\ValueObjects\Payment;

class Order
{
    private $id;
    private $code;
    private $customerId;
    private $items = [];
    private $payments = [];
    private $shipping;
    private $closed;

    public function __construct(
        $code,
        $customerId,
        array $items,
        array $payments,
        Shipping $shipping = null,
        $closed = true
    ) {
        $this->code = $code;
        $this->customerId = $customerId;
        $this->items = $items;
        $this->payments = $payments;
        $this->shipping = $shipping;
        $this->closed = $closed;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getCode() { return $this->code; }
    public function getCustomerId() { return $this->customerId; }
    public function getItems() { return $this->items; }
    public function getPayments() { return $this->payments; }
    public function getShipping() { return $this->shipping; }
    public function isClosed() { return $this->closed; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setCode($code) { $this->code = $code; }
    public function setCustomerId($customerId) { $this->customerId = $customerId; }
    public function setItems(array $items) { $this->items = $items; }
    public function setPayments(array $payments) { $this->payments = $payments; }
    public function setShipping(Shipping $shipping) { $this->shipping = $shipping; }
    public function setClosed(bool $closed) { $this->closed = $closed; }
}
