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

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Customer::class);
    }

    public function getAll(){
        foreach ($this->repository->findAll() as $customer) {
            $data[] = CustomerEntityFormmater::formatForAll($customer);
        }
        return $data;

    }

    /**
     * @param int $id
     */
    public function find(int $id){
        $Customer  = $this->repository->find($id);
        $result = CustomerEntityFormmater::getDefaultFormat($Customer);
        return $result;
    }

}
