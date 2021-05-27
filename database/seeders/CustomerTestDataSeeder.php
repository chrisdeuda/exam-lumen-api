<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTestDataSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@gmail.com',
            'password' => 'mypassword',
            'gender' => 'Male',
            'phone' => '123-45678',
            'country' => 'Philippines',
            'city' => 'Taguig'
        ]);
    }
}
