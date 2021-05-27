<?php

use App\Models\Customer;
use App\Services\CustomerDataImporter\CustomerEntityMapper;
use App\Services\CustomerEntityFormmater;

class CustomerDataFormatterTest extends TestCase
{

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $DefaultCustomer = new Customer();

    }

    /**
     * It should
     */
    public function testSettingCustomerDefaultProperties(): void
    {

        $customer = [
            'name' => [
                'first' => "John",
                'last' => "Doe",
            ],
            "email" => "johndoe@gmail.com",
            "login" => [
                "username" => "johndoe",
                "password" => "mypassword",
            ],
            "location" => [
                "country" => "Philippines",
                "city" => "Taguig",
            ],
            "gender" => "Male",
            "phone" => "123-45678",
        ];


        $customerModel = CustomerEntityMapper::mapDataToCustomerEntities($customer);

        $this->assertEquals($customerModel, $this->generateDefaultCustomerFormat());

    }



    public function testCustomersFormalForAll(): void{

        $Customer = $this->generateAllCustomerFormat();
        $formattedData = CustomerEntityFormmater::formatForAll($Customer);

        $expectedResult = [
            'full_name' => sprintf('%s %s', $Customer->getFirstName(), $Customer->getLastName()),
            'email' => $Customer->getEmail(),
            'country' => $Customer->getCountry(),
        ];

        $this->assertEquals($formattedData, $expectedResult);

    }

    /**
     * @return Customer
     */
    protected function generateAllCustomerFormat(): Customer
    {
        $DefaultCustomer = new Customer();
        $DefaultCustomer->setFirstName('John');
        $DefaultCustomer->setLastName('Doe');
        $DefaultCustomer->setEmail('johndoe@gmail.com');
        $DefaultCustomer->setCountry('Philippines');

        return $DefaultCustomer;
    }

    /**
     * @return Customer
     */
    protected function generateDefaultCustomerFormat(): Customer
    {
        $DefaultCustomer = new Customer();
        $DefaultCustomer->setFirstName('John');
        $DefaultCustomer->setLastName('Doe');
        $DefaultCustomer->setEmail('johndoe@gmail.com');
        $DefaultCustomer->setUsername('johndoe');
        $DefaultCustomer->setPassword('mypassword');
        $DefaultCustomer->setGender( "Male");
        $DefaultCustomer->setCountry("Philippines");
        $DefaultCustomer->setCity("Taguig");
        $DefaultCustomer->setPhone("123-45678");

        return $DefaultCustomer;
    }



}
