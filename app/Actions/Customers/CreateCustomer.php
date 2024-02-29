<?php
namespace App\Actions\Customers;

use App\Models\{User, Customer};
use Illuminate\Support\Facades\{Hash, Validator, DB};
use Illuminate\Http\{Request, JsonResponse};

class CreateCustomer 
{
    /**
     * A description of the entire PHP function.
     *
     * @param Request $request description
     * @throws Throwable description of exception
     * @return JsonResponse
     */
    public function execute(Array $data): JsonResponse
    {
        try {
            $validateUser = Validator::make($data, 
            [
                'company_name' => 'required|max:255',
                'responsible_name' => 'required|max:255',
                'nif' => 'required|max:14',
                'email' => 'required|email|unique:customers,email',
                'phone' => 'required|max:15',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $customer = Customer::create($data);
            $user = User::create([
                'name' => $customer->responsible_name,
                'customer_id' => $customer->id,
                'email' => $customer->email,
                'password' => Hash::make("admin")
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Customer created successfully',
                'customer' => $customer,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
