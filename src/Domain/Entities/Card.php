<?php
namespace FragosoSoftware\PagarmeSdk\Domain\Entities;

use FragosoSoftware\PagarmeSdk\Domain\ValueObjects\Address;

class Card
{
    private $id;
    private $billingAddress;
    private $number;
    private $holderName;
    private $holderDocument;
    private $expMonth;
    private $expYear;
    private $cvv;

    public function __construct(
        $id = null,
        Address $billingAddress,
        $number,
        $holderName,
        $holderDocument,
        $expMonth,
        $expYear,
        $cvv
    ) {
        $this->id = $id;
        $this->billingAddress = $billingAddress;
        $this->number = $number;
        $this->holderName = $holderName;
        $this->holderDocument = $holderDocument;
        $this->expMonth = $expMonth;
        $this->expYear = $expYear;
        $this->cvv = $cvv;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getHolderName()
    {
        return $this->holderName;
    }

    public function getHolderDocument()
    {
        return $this->holderDocument;
    }

    public function getExpMonth()
    {
        return $this->expMonth;
    }

    public function getExpYear()
    {
        return $this->expYear;
    }

    public function getCvv()
    {
        return $this->cvv;
    }

    // Setters (opcionais para atualizações)
    public function setBillingAddress(Address $billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    public function setHolderName($holderName)
    {
        $this->holderName = $holderName;
    }

    public function setHolderDocument($holderDocument)
    {
        $this->holderDocument = $holderDocument;
    }

    public function setExpMonth($expMonth)
    {
        $this->expMonth = $expMonth;
    }

    public function setExpYear($expYear)
    {
        $this->expYear = $expYear;
    }
}
