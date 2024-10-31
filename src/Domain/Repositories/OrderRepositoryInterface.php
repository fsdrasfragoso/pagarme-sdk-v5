
<?php

namespace FragosoSoftware\PagarmeSdk\Domain\Repositories;

interface OrderRepositoryInterface
{
    /**
     * Create a new order.
     *
     * @param array $orderData The data for creating the order.
     * @return array The response from the API.
     */
    public function create(array $orderData);

    /**
     * Add a new charge to an existing order.
     *     
     * @param array $chargeData The data for the charge.
     * @return array The response from the API.
     */
    public function addCharge(array $chargeData);

    /**
     * Create a multi-payment order.
     *
     * @param array $multiPaymentData The data for the multi-payment order.
     * @return array The response from the API.
     */
    public function createMultiPayment(array $multiPaymentData);

    /**
     * Create a multi-buyer order.
     *
     * @param array $multiBuyerData The data for the multi-buyer order.
     * @return array The response from the API.
     */
    public function createMultiBuyer(array $multiBuyerData);

    /**
     * Retrieve an order by its ID.
     *
     * @param string $orderId The ID of the order.
     * @return array The response from the API.
     */
    public function findById(string $orderId);

     /**
     * Close an order by ID.
     *
     * @param string $orderId
     * @param array $data
     * @return array
     */
    public function close(string $orderId, array $data);

    /**
     * List orders based on filters.
     *
     * @param array $filters Optional filters for listing orders.
     * @return array The list of orders.
     */
    public function list(array $filters = []);
}
