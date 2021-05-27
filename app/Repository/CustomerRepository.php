<?php

namespace App\Repository;

use App\Models\Customer;
use App\Services\CustomerEntityFormmater;
use Doctrine\ORM\EntityManagerInterface;

class CustomerRepository implements EntityRepositoryInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var \Doctrine\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * CustomerRepository constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Customer::class);
    }

    /**
     * Return all customers
     *
     * @return array
     */
    public function getAll(){
        foreach ($this->repository->findAll() as $customer) {
            $data[] = CustomerEntityFormmater::formatForAll($customer);
        }
        return $data;

    }

    /**
     * Search for specific customer
     *
     * @param int $id
     * @return Object
     */
    public function find(int $id): object
    {
        $Customer  = $this->repository->find($id);
        return CustomerEntityFormmater::getDefaultFormat($Customer);
    }

}
