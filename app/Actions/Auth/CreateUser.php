<?php
namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class CreateUser 
{
    /**
     * A description of the entire PHP function.
     *
     * @param array $data description
     * @param mixed $user description
     * @throws \Throwable description of exception
     * @return JsonResponse
     */
    public function execute(array $data, $user): JsonResponse
    {
        try {
            $validateUser = Validator::make($data, 
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $data['name'],
                'customer_id' => $user->customer_id,
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'customer_id' => $user->customer_id,
                'email' => $user->email
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
