<?php
namespace FragosoSoftware\PagarmeSdk\Application\DTO;

class PhoneNumbersDTO
{
    public $ddd;
    public $number;
    public $type;

    public function __construct($ddd, $number, $type)
    {
        $this->ddd = $ddd;
        $this->number = $number;
        $this->type = $type;
    }
}
