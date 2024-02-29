<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};
use App\Actions\Customers\CreateCustomer;

class CustomerController extends Controller
{
    /**
     * Store the customer data using the provided request and CreateCustomer instance.
     *
     * @param Request $request The request containing the customer data
     * @param CreateCustomer $createCustomer The CreateCustomer instance
     * @return JsonResponse
     */
    public function store(Request $request, CreateCustomer $createCustomer): JsonResponse
    {
        return $createCustomer->execute($request->all());
    }
}
