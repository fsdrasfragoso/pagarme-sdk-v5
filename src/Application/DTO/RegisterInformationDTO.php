<?php
namespace FragosoSoftware\PagarmeSdk\Application\DTO;

use FragosoSoftware\PagarmeSdk\Application\DTO\ManagingPartnersAddressDTO;

class RegisterInformationDTO
{
    public $mainAddress;
    public $email;
    public $document;
    public $type;
    public $companyName;
    public $tradingName;
    public $annualRevenue;
    public $corporationType;
    public $foundingDate;
    public $managingPartners;
    public $phoneNumbers;

    public function __construct(
        ManagingPartnersAddressDTO $mainAddress,
        $email,
        $document,
        $type,
        $companyName,
        $tradingName,
        $annualRevenue,
        $corporationType,
        $foundingDate,
        array $managingPartners,
        array $phoneNumbers // Lista de PhoneNumbersDTO
    ) {
        $this->mainAddress = $mainAddress;
        $this->email = $email;
        $this->document = $document;
        $this->type = $type;
        $this->companyName = $companyName;
        $this->tradingName = $tradingName;
        $this->annualRevenue = $annualRevenue;
        $this->corporationType = $corporationType;
        $this->foundingDate = $foundingDate;
        $this->managingPartners = $managingPartners;
        $this->phoneNumbers = $phoneNumbers;
    }
}
