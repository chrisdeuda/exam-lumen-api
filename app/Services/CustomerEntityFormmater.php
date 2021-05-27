<?php

namespace App\Services;

use App\Models\Customer;

class CustomerEntityFormmater{

    /**
     * @var Customer
     */
    public $formattedCustomer;


    /**
     * @param Customer $customer
     *
     * @return array
     */
    public static function formatForAll(Customer $customer):array{
        $customerData = [];
        $customerData['full_name'] = sprintf('%s %s', $customer->getFirstName(), $customer->getLastName());
        $customerData['email'] = $customer->getEmail();
        $customerData['country'] = $customer->getCountry();
        return $customerData;

    }

    /**
     * @param Customer $Customer
     */
    public  static function getDefaultFormat(Customer $Customer)  {

        $FormattedCustomer = new \stdClass();

        $FormattedCustomer->full_name = sprintf('%s %s', $Customer->getFirstName(), $Customer->getLastName());
        $FormattedCustomer->email = $Customer->getEmail();
        $FormattedCustomer->username = $Customer->getUsername();
        $FormattedCustomer->gender = $Customer->getGender();
        $FormattedCustomer->country = $Customer->getCountry();
        $FormattedCustomer->city = $Customer->getCity();
        $FormattedCustomer->phone = $Customer->getPhone();

        return $FormattedCustomer;
    }
}
