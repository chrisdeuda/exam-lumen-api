<?php


namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use App\Models\Customer;
use App\Services\CustomerDataImporter\CustomerEntityMapper;


class ImportUserService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var \Doctrine\Persistence\ObjectRepository
     */
    private $customerEntityRepository;

    /**
     * ImportUserService constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager){

        $this->entityManager = $entityManager;
        $this->customerEntityRepository = $entityManager->getRepository(Customer::class);

    }

    /**
     * @param array $customers_data
     *
     * @return void
     */
    public function saveMultipleCustomerData(array $customers_data): void{

        if(count($customers_data)){
            foreach($customers_data as $customer) {

                // Update the existing customer if already exist using magic method
                $existingCustomerEntity = $this->customerEntityRepository->findOneByEmail($customer['email']);

                if( !$existingCustomerEntity ) {
                    $FormattedCustomer = CustomerEntityMapper::mapDataToCustomerEntities($customer);
                } else {
                    $FormattedCustomer = CustomerEntityMapper::updateExistingCustomer($existingCustomerEntity, $customer);
                }
                $this->entityManager->persist($FormattedCustomer);
            }

            $this->entityManager->flush();
        }
    }

}
