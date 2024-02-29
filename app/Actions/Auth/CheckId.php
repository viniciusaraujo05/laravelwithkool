<?php
namespace App\Actions\Auth;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CheckId
{
    /**
     * A description of the entire PHP function.
     *
     * @param array $data description
     * @throws Throwable description of exception
     * @return JsonResponse
     */
    public function execute(array $data): JsonResponse
    {
        try{
            $customer = Customer::where('id', $data['id']);
            if($customer->exists()){
                $response = response()->json([
                    'status' => true,
                    'customer' => $customer->first()
                ], 200);
                session(['user_id' => $data['id']]);

                return $response;
            }
                
            return response()->json([
                'status' => false,
                'message' => 'Customer not found'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
