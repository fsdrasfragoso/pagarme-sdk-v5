
<?php
namespace FragosoSoftware\PagarmeSdk\Interfaces\Http\Controllers;

use FragosoSoftware\PagarmeSdk\Application\Services\OrderService;
use FragosoSoftware\PagarmeSdk\Application\DTO\OrderDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\ItemDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\ShippingDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\PaymentDTO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FragosoSoftware\PagarmeSdk\Domain\Enums\PaymentMethod;

class OrderController
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create(Request $request)
    {
        $items = array_map(function ($item) {
            return new ItemDTO($item['amount'], $item['description'], $item['quantity'], $item['code']);
        }, $request->get('items'));

        $shippingData = $request->get('shipping');
        $shipping = new ShippingDTO(
            $shippingData['amount'],
            $shippingData['description'],
            $shippingData['recipient_name'],
            $shippingData['recipient_phone'],
            $shippingData['address']['country'],
            $shippingData['address']['state'],
            $shippingData['address']['city'],
            $shippingData['address']['zip_code'],
            $shippingData['address']['line_1'],
            $shippingData['address']['line_2'] ?? null
        );

        $paymentMethod = PaymentMethod::from($request->get('payment_method'));
        $payment = new PaymentDTO($request->get('amount'), $paymentMethod);

        $orderDTO = new OrderDTO(
            $request->get('code'),
            $request->get('customer_id'),
            $items,
            [$payment],
            $shipping
        );

        try {
            $response = $this->orderService->createOrder($orderDTO);
            return new JsonResponse($response, JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    public function getOrder($orderId)
    {
        try {
            $order = $this->orderService->getOrder($orderId);
            return new JsonResponse($order, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    public function closeOrder($orderId)
    {
        try {
            $response = $this->orderService->closeOrder($orderId);
            return new JsonResponse($response, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    public function listOrders(Request $request)
    {
        $filters = $request->query->all();

        try {
            $orders = $this->orderService->listOrders($filters);
            return new JsonResponse($orders, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
