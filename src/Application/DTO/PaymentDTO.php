<?php

namespace App\Application\DTO;

use App\Domain\Enums\PaymentMethod;

class PaymentDTO
{
    public $amount;
    public $paymentMethod;
    public $pixPayment;
    public $boletoPayment;
    public $creditCardPayment;
    public $split;

    public function __construct(
        int $amount,
        PaymentMethod $paymentMethod,
        $paymentDetails = null,
        array $split = []
    ) {
        $this->amount = $amount;
        $this->paymentMethod = $paymentMethod;
        $this->split = $split;

        if ($paymentMethod === PaymentMethod::PIX && $paymentDetails instanceof PixPaymentDTO) {
            $this->pixPayment = $paymentDetails;
        } elseif ($paymentMethod === PaymentMethod::BOLETO && $paymentDetails instanceof BoletoPaymentDTO) {
            $this->boletoPayment = $paymentDetails;
        } elseif ($paymentMethod === PaymentMethod::CREDIT_CARD && $paymentDetails instanceof CreditCardPaymentDTO) {
            $this->creditCardPayment = $paymentDetails;
        }
    }
}
