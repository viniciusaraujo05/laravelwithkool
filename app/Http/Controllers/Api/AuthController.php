<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\{Request, JsonResponse};
use App\Actions\Auth\{CreateUser, LoginUser, CheckId};
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request, CreateUser $createUser)
    {
        return $createUser->execute($request->all(), $request->user());
    }

    /**
     * Login The User
     * @param Request $request
     * @return JsonResponse
     */
    public function loginUser(Request $request, LoginUser $loginUser)
    {
       return $loginUser->execute($request);
    }

    /**
     * Check Id
     * @param Request $request
     * @return JsonResponse
     */
    public function checkId(Request $request, CheckId $checkId)
    {
        return $checkId->execute($request->all());
    }
}
