<?php
namespace FragosoSoftware\PagarmeSdk\Application\DTO;

class BankAccountDTO
{
    public $holderName;
    public $holderType;
    public $holderDocument;
    public $bank;
    public $branchNumber;
    public $accountNumber;
    public $accountCheckDigit;
    public $type;

    public function __construct(
        $holderName,
        $holderType,
        $holderDocument,
        $bank,
        $branchNumber,
        $accountNumber,
        $accountCheckDigit,
        $type
    ) {
        $this->holderName = $holderName;
        $this->holderType = $holderType;
        $this->holderDocument = $holderDocument;
        $this->bank = $bank;
        $this->branchNumber = $branchNumber;
        $this->accountNumber = $accountNumber;
        $this->accountCheckDigit = $accountCheckDigit;
        $this->type = $type;
    }
}
