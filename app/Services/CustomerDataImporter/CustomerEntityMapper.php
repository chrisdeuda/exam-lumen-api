<?php

namespace App\Services\CustomerDataImporter;


use App\Entities\Customer;

/**
 * Class CustomerEntityMapper
 * @package App\Services\CustomerDataImporter
 */
class CustomerEntityMapper {

    public function __construct(array $customer_data){

    }

    /**
     * @param array $customer_data
     */

    /**
     * @param array $customer
     *
     * @return Customer
     */
    public static function  mapDataToCustomerEntities(array $customer){
        $Customer = new Customer();

        $Customer->setFirstName( $customer['name']['first']);
        $Customer->setLastName($customer['name']['last']);
        $Customer->setUsername($customer['login']['username']);
        $Customer->setPassword(md5($customer['login']['password']));
        $Customer->setGender($customer['gender']);
        $Customer->setEmail($customer['email']);
        $Customer->setCountry($customer['location']['country']);
        $Customer->setCity($customer['location']['city']);
        $Customer->setPhone($customer['phone']);

        return $Customer;

    }

    /**
     * @param Customer $Customer
     * @param array $customer_data
     * @return Customer
     */
    public static function updateExistingCustomer(Customer $Customer, array $customer_data): Customer
    {
        $Customer->setFirstName( $customer_data['name']['first']);
        $Customer->setLastName($customer_data['name']['last']);
        $Customer->setUsername($customer_data['login']['username']);
        $Customer->setPassword(md5($customer_data['login']['password']));
        $Customer->setGender($customer_data['gender']);
        $Customer->setEmail($customer_data['email']);
        $Customer->setCountry($customer_data['location']['country']);
        $Customer->setCity($customer_data['location']['city']);
        $Customer->setPhone($customer_data['phone']);

        return $Customer;

    }

}
