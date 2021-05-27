<?php
namespace App\Console\Commands;

use App\Services\CustomerDataImporter\RandomDataAPI;
use App\Services\ImportUserService;
use Exception;
use Illuminate\Console\Command;

/**
 * Class CustomerDataImportCommand
 *
 * @package App\Console\Commands
 */
class CustomerDataImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It import customer data from https://randomuser.me';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ImportUserService $ImportUserService)
    {
        try{
            $response = RandomDataAPI::getData();
            $ImportUserService->saveMultipleCustomerData($response);
            $this->info("Success");
        } catch(Exception $e){
            $this->error($e->getMessage());
        }

    }

}
