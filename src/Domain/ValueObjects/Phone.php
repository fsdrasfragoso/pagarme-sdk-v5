<?php
namespace FragosoSoftware\PagarmeSdk\Domain\ValueObjects;

class Phone
{
    private $homePhone;
    private $mobilePhone;

    public function __construct(HomePhone $homePhone = null, MobilePhone $mobilePhone = null)
    {
        $this->homePhone = $homePhone;
        $this->mobilePhone = $mobilePhone;
    }

    // Getters
    public function getHomePhone() { return $this->homePhone; }
    public function getMobilePhone() { return $this->mobilePhone; }
}
