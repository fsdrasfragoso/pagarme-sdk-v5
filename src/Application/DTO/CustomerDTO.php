<?php

namespace App\Application\DTO;

class CustomerDTO
{
    public $name;
    public $email;
    public $code;
    public $document;
    public $documentType;
    public $type;
    public $gender;
    public $address;
    public $phones;

    public function __construct(
        $name,
        $email,
        $code,
        $document,
        $documentType,
        $type,
        $gender,
        AddressDTO $address,
        PhoneDTO $phones
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->code = $code;
        $this->document = $document;
        $this->documentType = $documentType;
        $this->type = $type;
        $this->gender = $gender;
        $this->address = $address;
        $this->phones = $phones;
    }
}
