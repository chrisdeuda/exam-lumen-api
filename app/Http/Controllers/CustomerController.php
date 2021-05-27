<?php

namespace App\Http\Controllers;

use App\Repository\CustomerRepository;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;


class CustomerController extends Controller
{
    /**
     * CustomerController constructor.
     *
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @return array
     */
    public function all(): JsonResponse
    {
        return response()->json([
                'results' => $this->customerRepository->getAll()
        ]);
    }

    /**
     * @param int $customerId
     * @return JsonResponse
     */
    public function find(int $customerId): JsonResponse
    {

        return response()->json(
            [
                'results'=>$this->customerRepository->find($customerId)
            ]
        );

    }
}
