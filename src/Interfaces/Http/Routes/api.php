<?php

use FragosoSoftware\PagarmeSdk\Interfaces\Http\Controllers\CustomerController;
use FragosoSoftware\PagarmeSdk\Application\Services\CustomerService;
use FragosoSoftware\PagarmeSdk\Infrastructure\Repositories\CustomerRepository;
use FragosoSoftware\PagarmeSdk\Infrastructure\Http\PagarmeApiClient;
use Symfony\Component\HttpFoundation\Request;
use FragosoSoftware\PagarmeSdk\Interfaces\Http\Controllers\CardController;
use FragosoSoftware\PagarmeSdk\Application\Services\CardService;
use FragosoSoftware\PagarmeSdk\Infrastructure\Repositories\CardRepository;
use FragosoSoftware\PagarmeSdk\Interfaces\Http\Controllers\OrderController;
use FragosoSoftware\PagarmeSdk\Application\Services\OrderService;
use FragosoSoftware\PagarmeSdk\Infrastructure\Repositories\OrderRepository;

$router->post('/customers', function (Request $request) {
    $storeAccessToken = getenv('PAGARME_STORE_ACCESS_TOKEN');
    $apiClient = new PagarmeApiClient($storeAccessToken);
    $repository = new CustomerRepository($apiClient);
    $customerService = new CustomerService($repository);
    $controller = new CustomerController($customerService);

    return $controller->create($request);
});

$router->get('/customers/{id}', function ($id) {
    $storeAccessToken = getenv('PAGARME_STORE_ACCESS_TOKEN');
    $apiClient = new PagarmeApiClient($storeAccessToken);
    $repository = new CustomerRepository($apiClient);
    $customerService = new CustomerService($repository);
    $controller = new CustomerController($customerService);

    return $controller->getCustomerById($id);
});

$router->put('/customers/{id}', function (Request $request, $id) {
    $storeAccessToken = getenv('PAGARME_STORE_ACCESS_TOKEN');
    $apiClient = new PagarmeApiClient($storeAccessToken);
    $repository = new CustomerRepository($apiClient);
    $customerService = new CustomerService($repository);
    $controller = new CustomerController($customerService);

    return $controller->update($request, $id);
});

$router->post('/customers/{customerId}/cards', function (Request $request, $customerId) {
    $storeAccessToken = getenv('PAGARME_STORE_ACCESS_TOKEN');
    $apiClient = new PagarmeApiClient($storeAccessToken);
    $repository = new CardRepository($apiClient);
    $cardService = new CardService($repository);
    $controller = new CardController($cardService);

    return $controller->create($request, $customerId);
});

$router->get('/customers/{customerId}/cards/{cardId}', function ($customerId, $cardId) {
    $storeAccessToken = getenv('PAGARME_STORE_ACCESS_TOKEN');
    $apiClient = new PagarmeApiClient($storeAccessToken);
    $repository = new CardRepository($apiClient);
    $cardService = new CardService($repository);
    $controller = new CardController($cardService);

    return $controller->getById($customerId, $cardId);
});

$router->get('/customers/{customerId}/cards', function ($customerId) {
    $storeAccessToken = getenv('PAGARME_STORE_ACCESS_TOKEN');
    $apiClient = new PagarmeApiClient($storeAccessToken);
    $repository = new CardRepository($apiClient);
    $cardService = new CardService($repository);
    $controller = new CardController($cardService);

    return $controller->list($customerId);
});

$router->put('/customers/{customerId}/cards/{cardId}', function (Request $request, $customerId, $cardId) {
    $storeAccessToken = getenv('PAGARME_STORE_ACCESS_TOKEN');
    $apiClient = new PagarmeApiClient($storeAccessToken);
    $repository = new CardRepository($apiClient);
    $cardService = new CardService($repository);
    $controller = new CardController($cardService);

    return $controller->update($request, $customerId, $cardId);
});

$router->delete('/customers/{customerId}/cards/{cardId}', function ($customerId, $cardId) {
    $storeAccessToken = getenv('PAGARME_STORE_ACCESS_TOKEN');
    $apiClient = new PagarmeApiClient($storeAccessToken);
    $repository = new CardRepository($apiClient);
    $cardService = new CardService($repository);
    $controller = new CardController($cardService);

    return $controller->delete($customerId, $cardId);
});

$router->post('/customers/{customerId}/cards/{cardId}/renew', function ($customerId, $cardId) {
    $storeAccessToken = getenv('PAGARME_STORE_ACCESS_TOKEN');
    $apiClient = new PagarmeApiClient($storeAccessToken);
    $repository = new CardRepository($apiClient);
    $cardService = new CardService($repository);
    $controller = new CardController($cardService);

    return $controller->renew($customerId, $cardId);
});

$router->post('/orders', function (Request $request) {
    $storeAccessToken = getenv('PAGARME_STORE_ACCESS_TOKEN');
    $apiClient = new PagarmeApiClient($storeAccessToken);
    $repository = new OrderRepository($apiClient);
    $orderService = new OrderService($repository);
    $controller = new OrderController($orderService);

    return $controller->create($request);
});



$router->get('/orders/{orderId}', function ($orderId) {
    $storeAccessToken = getenv('PAGARME_STORE_ACCESS_TOKEN');
    $apiClient = new PagarmeApiClient($storeAccessToken);
    $repository = new OrderRepository($apiClient);
    $orderService = new OrderService($repository);
    $controller = new OrderController($orderService);

    return $controller->getOrder($orderId);
});

$router->patch('/orders/{orderId}/close', function ($orderId) {
    $storeAccessToken = getenv('PAGARME_STORE_ACCESS_TOKEN');
    $apiClient = new PagarmeApiClient($storeAccessToken);
    $repository = new OrderRepository($apiClient);
    $orderService = new OrderService($repository);
    $controller = new OrderController($orderService);

    return $controller->closeOrder($orderId);
});

$router->get('/orders', function (Request $request) {
    $storeAccessToken = getenv('PAGARME_STORE_ACCESS_TOKEN');
    $apiClient = new PagarmeApiClient($storeAccessToken);
    $repository = new OrderRepository($apiClient);
    $orderService = new OrderService($repository);
    $controller = new OrderController($orderService);

    return $controller->listOrders($request);
});
