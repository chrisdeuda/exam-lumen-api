<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class ApiCustomerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->artisan('db:seed --class=CustomerTestDataSeeder');
    }

    /**
     * @return void
     */
    public function testCustomersStatusOk(): void
    {
        $response = $this->call('GET', '/customers');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @return void
     */
    public function testCustomerExistInDB(): void
    {
        $this->seeInDatabase('customers', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@gmail.com',
            'password' => ('mypassword'),
            'gender' => 'Male',
            'phone' => '123-45678',
            'country' => 'Philippines',
            'city' => 'Taguig'
        ]);
    }

    /**
     * @return void
     */
    public function testApiCustomerIdIsInvalid(): void
    {
        $response = $this->call('GET', '/customers/not-id');
        $this->assertEquals(500, $response->status());
    }

    /**
     * @return void
     */
    public function testApiCustomerIdIsValid(): void
    {
        $user_id = 1;
        $response = $this->call('GET', "/customers/${user_id}" );
        $this->assertEquals(200, $response->status());
    }

    /**
     * @return void
     */
    public function testApiCustomerReturnAll(): void
    {
        $response = $this->call('GET', "/customers/" );
        $this->assertEquals(200, $response->status());
    }

    /**
     * @return void
     */
    public function testApiCustomerHasReturnJson(): void
    {
        $response = $this->call('GET', "/customers/" );
        $this->assertArrayHasKey('results', $response);
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        parent::setUp();
        $this->artisan('migrate:rollback');
    }

}
