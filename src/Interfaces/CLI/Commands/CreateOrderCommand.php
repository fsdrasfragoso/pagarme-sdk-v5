
<?php
namespace FragosoSoftware\PagarmeSdk\Interfaces\CLI\Commands;

use FragosoSoftware\PagarmeSdk\Application\Services\OrderService;
use FragosoSoftware\PagarmeSdk\Application\DTO\OrderDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\ItemDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\ShippingDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\PaymentDTO;
use FragosoSoftware\PagarmeSdk\Domain\Enums\PaymentMethod;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateOrderCommand extends Command
{
    protected static $defaultName = 'order:create';
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        parent::__construct();
        $this->orderService = $orderService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates a new order in the Pagar.me API')
            ->addArgument('code', InputArgument::REQUIRED, 'Order reference code')
            ->addArgument('customerId', InputArgument::REQUIRED, 'Customer ID')
            ->addArgument('amount', InputArgument::REQUIRED, 'Total order amount')
            ->addArgument('items', InputArgument::IS_ARRAY, 'Items in the order (format: amount,description,quantity,code)')
            ->addArgument('paymentMethod', InputArgument::REQUIRED, 'Payment method (credit_card, boleto, pix)')
            ->addArgument('shipping', InputArgument::IS_ARRAY, 'Shipping details (amount, description, recipient_name, recipient_phone, country, state, city, zip_code, line_1, line_2)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $items = [];
        foreach ($input->getArgument('items') as $itemData) {
            [$amount, $description, $quantity, $code] = explode(',', $itemData);
            $items[] = new ItemDTO((int)$amount, $description, (int)$quantity, $code);
        }

        $shippingData = $input->getArgument('shipping');
        $shipping = new ShippingDTO(
            $shippingData[0], $shippingData[1], $shippingData[2], $shippingData[3],
            $shippingData[4], $shippingData[5], $shippingData[6], $shippingData[7],
            $shippingData[8], $shippingData[9] ?? null
        );

        $paymentMethod = PaymentMethod::from($input->getArgument('paymentMethod'));
        $payment = new PaymentDTO((int)$input->getArgument('amount'), $paymentMethod);

        $orderDTO = new OrderDTO(
            $input->getArgument('code'),
            $input->getArgument('customerId'),
            $items,
            [$payment],
            $shipping
        );

        try {
            $response = $this->orderService->createOrder($orderDTO);
            $output->writeln("<info>Order created successfully! Order ID: {$response['id']}</info>");
        } catch (\Exception $e) {
            $output->writeln("<error>Error creating order: {$e->getMessage()}</error>");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
