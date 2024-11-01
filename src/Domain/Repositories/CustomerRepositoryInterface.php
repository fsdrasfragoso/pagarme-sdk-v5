<?php
namespace FragosoSoftware\PagarmeSdk\Domain\Repositories;

interface CustomerRepositoryInterface
{
    public function create(array $customerData);
    public function findById($customerId);
    public function update($customerId, array $customerData);
    public function list(array $filters = []);

}

