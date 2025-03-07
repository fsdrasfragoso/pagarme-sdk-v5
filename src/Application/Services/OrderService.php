<?php
namespace FragosoSoftware\PagarmeSdk\Application\Services;

use FragosoSoftware\PagarmeSdk\Application\DTO\OrderDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\PaymentDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\SplitDTO;
use FragosoSoftware\PagarmeSdk\Domain\Repositories\OrderRepositoryInterface;
use FragosoSoftware\PagarmeSdk\Domain\Enums\PaymentMethod;

class OrderService
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }


    public function setStoreAccessToken($storeAccessToken)
    {
        $this->orderRepository->setStoreAccessToken($storeAccessToken); 
    }


    public function createOrder(OrderDTO $orderData)
    {
        $orderArray = [
            'code' => $orderData->code,
            'customer_id' => $orderData->customerId,
            'items' => array_map([$this, 'convertItemToArray'], $orderData->items),
            'payments' => array_map([$this, 'convertPaymentToArray'], $orderData->payments), 
            'shipping' => $this->convertShippingToArray($orderData->shipping),
            'closed' => $orderData->closed,
            'metadata'=>['aplicativo'=>'Smplaces'],
        ];
    
        return $this->orderRepository->create($orderArray);
    }

    public function createMultiPaymentOrder(OrderDTO $orderData)
    {
        $orderArray = [
            'code' => $orderData->code,
            'customer_id' => $orderData->customerId,
            'items' => array_map([$this, 'convertItemToArray'], $orderData->items),
            'payments' => array_map([$this, 'convertPaymentToArray'], $orderData->payments), 
            'shipping' => $this->convertShippingToArray($orderData->shipping),
            'closed' => $orderData->closed,
        ];

        return $this->orderRepository->createMultiPayment($orderArray);
    }

    public function createMultiCustomerOrder(OrderDTO $orderData)
    {
        $orderArray = [
            'code' => $orderData->code,
            'customer_id' => $orderData->customerId,
            'items' => array_map([$this, 'convertItemToArray'], $orderData->items),
            'payments' => array_map([$this, 'convertPaymentToArray'], $orderData->payments), 
            'shipping' => $this->convertShippingToArray($orderData->shipping),
            'closed' => $orderData->closed,
        ];

        return $this->orderRepository->createMultiBuyer($orderArray);
    }

    public function getOrder($orderId)
    {
        return $this->orderRepository->findById($orderId);
    }

    public function closeOrder($orderId, $status = 'canceled ')
    {
        return $this->orderRepository->close($orderId, ['status' => $status]);
    }


    public function addChargeToOrder(string $orderId, PaymentDTO $paymentData, int $amount)
    {
        $chargeData = [
            'order_id' => $orderId,
            'amount' => $amount,
            'payment' => $this->convertPaymentToArray($paymentData)
        ];

        return $this->orderRepository->addCharge($chargeData);
    }

    private function convertItemToArray($item)
    {
        return [
            'amount' => $item->amount,
            'description' => $item->description,
            'quantity' => $item->quantity,
            'code' => $item->code,
        ];
    }

    private function convertShippingToArray($shipping)
    {
        return [
            'amount' => $shipping->amount,
            'description' => $shipping->description,
            'recipient_name' => $shipping->recipientName,
            'recipient_phone' => $shipping->recipientPhone,
            'address' => [
                'country' => $shipping->address->country,
                'state' => $shipping->address->state,
                'city' => $shipping->address->city,
                'zip_code' => $shipping->address->zipCode,
                'line_1' => $shipping->address->line1,
                'line_2' => $shipping->address->line2,
            ]
        ];
    }

    private function convertPaymentToArray(PaymentDTO $payment)
    {
        $paymentData = [
            'payment_method' => $payment->paymentMethod,
            'amount' => $payment->amount,
        ];

        if ($payment->paymentMethod === PaymentMethod::CREDIT_CARD) {
            $paymentData['credit_card'] = [
                'operation_type' => $payment->creditCardPayment->operationType,
                'installments' => $payment->creditCardPayment->installments,
                'statement_descriptor' => $payment->creditCardPayment->statementDescriptor,
                'card_id' => $payment->creditCardPayment->cardId,
            ];
        } elseif ($payment->paymentMethod === PaymentMethod::BOLETO) {
            $paymentData['boleto'] = [
                'instructions' => $payment->boletoPayment->instructions,
                'due_at' => $payment->boletoPayment->dueAt,
                'nosso_numero' => $payment->boletoPayment->nossoNumero,
                'interest' => $this->convertInterestOrFine($payment->boletoPayment->interest),
                'fine' => $this->convertInterestOrFine($payment->boletoPayment->fine),
            ];
        } elseif ($payment->paymentMethod === PaymentMethod::PIX) {
            $paymentData['pix'] = [
                'expires_in' => $payment->pixPayment->expiresIn,
                'expires_at' => $payment->pixPayment->expiresAt,
                'additional_information' => $payment->pixPayment->additionalInformation,
            ];
        }

        if (!empty($payment->split)) {
            $paymentData['split'] = array_map([$this, 'convertSplitToArray'], $payment->split);
        }

        return $paymentData;
    }

    private function convertInterestOrFine($detail)
    {
        if (!$detail) return null;

        return [
            'days' => $detail->days,
            'type' => $detail->type,
            'amount' => $detail->amount,
        ];
    }

    private function convertSplitToArray(SplitDTO $split)
    {
        return [
            'amount' => $split->amount,
            'recipient_id' => $split->recipientId,
            'type' => $split->type,
            'options' => [
                'charge_processing_fee' => $split->options->chargeProcessingFee,
                'liable' => $split->options->liable,
                'charge_remainder_fee' => $split->options->chargeRemainderFee,
            ]
        ];
    }

     
    public function listOrders(array $filters = [])
    {
        return $this->orderRepository->list($filters);
    }
}
