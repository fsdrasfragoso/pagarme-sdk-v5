<?php

namespace FragosoSoftware\PagarmeSdk\Application\DTO;

class SplitOptionsDTO
{
    public $chargeProcessingFee;
    public $liable;
    public $chargeRemainderFee;

    public function __construct(
        bool $chargeProcessingFee,
        bool $liable,
        bool $chargeRemainderFee
    ) {
        $this->chargeProcessingFee = $chargeProcessingFee;
        $this->liable = $liable;
        $this->chargeRemainderFee = $chargeRemainderFee;
    }
}
