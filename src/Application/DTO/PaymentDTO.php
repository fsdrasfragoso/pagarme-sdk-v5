<?php
namespace FragosoSoftware\PagarmeSdk\Application\DTO;

use FragosoSoftware\PagarmeSdk\Domain\Enums\PaymentMethod;

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
        string $paymentMethod,
        $paymentDetails = null,
        array $split = []
    ) {
        if (!in_array($paymentMethod, [PaymentMethod::CREDIT_CARD, PaymentMethod::BOLETO, PaymentMethod::PIX])) {
            throw new \InvalidArgumentException("Invalid payment method: $paymentMethod");
        }

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
