<?php

namespace App\Http\Controllers;

use App\Services\CustomerDataImporter\RandomDataAPI;
use App\Services\ImportUserService;
use Doctrine\ORM\EntityManagerInterface;

class UsersImportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function importUser(EntityManagerInterface $entityManager){

        $ImportUserService = new ImportUserService($entityManager);

        $response = RandomDataAPI::getData();

        return $ImportUserService->saveMultipleCustomerData($response);
    }


}
