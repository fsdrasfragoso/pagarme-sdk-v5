<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Address;
use App\Domain\ValueObjects\Phone;

class Customer
{
    private $id;
    private $name;
    private $email;
    private $code;
    private $document;
    private $documentType;
    private $type;
    private $gender;
    private $address;
    private $phones;

    public function __construct(
        $id,
        $name,
        $email,
        $code,
        $document,
        $documentType,
        $type,
        $gender,
        Address $address,
        Phone $phones
    ) {
        $this->id = $id;
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

    // Getters
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getCode() { return $this->code; }
    public function getDocument() { return $this->document; }
    public function getDocumentType() { return $this->documentType; }
    public function getType() { return $this->type; }
    public function getGender() { return $this->gender; }
    public function getAddress() { return $this->address; }
    public function getPhones() { return $this->phones; }
}
