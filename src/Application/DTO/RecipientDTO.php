<?php
namespace FragosoSoftware\PagarmeSdk\Application\DTO;

use FragosoSoftware\PagarmeSdk\Application\DTO\RegisterInformationDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\BankAccountDTO;

class RecipientDTO
{
    public $code;
    public $registerInformation;
    public $defaultBankAccount;

    public function __construct(
        $code,
        RegisterInformationDTO $registerInformation,
        BankAccountDTO $defaultBankAccount
    ) {
        $this->code = $code;
        $this->registerInformation = $registerInformation;
        $this->defaultBankAccount = $defaultBankAccount;
    }
}
