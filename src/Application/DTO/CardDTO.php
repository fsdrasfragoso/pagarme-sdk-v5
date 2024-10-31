<?php

namespace App\Application\DTO;

class CardDTO
{
    public $billingAddress;
    public $number;
    public $holderName;
    public $holderDocument;
    public $expMonth;
    public $expYear;
    public $cvv;

    public function __construct(
        AddressDTO $billingAddress,
        $number,
        $holderName,
        $holderDocument,
        $expMonth,
        $expYear,
        $cvv
    ) {
        $this->billingAddress = $billingAddress;
        $this->number = $number;
        $this->holderName = $holderName;
        $this->holderDocument = $holderDocument;
        $this->expMonth = $expMonth;
        $this->expYear = $expYear;
        $this->cvv = $cvv;
    }
}
