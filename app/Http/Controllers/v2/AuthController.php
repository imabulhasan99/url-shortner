<?php

namespace App\Http\Controllers\v2;

use Illuminate\Http\Request;
use App\Services\v2\LoginService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Services\v2\RegistrationService;
use App\Http\Requests\RegistrationRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request, RegistrationService $service){
       $data = $request->validated();
       $result = $service->register($data);
       return $result;
    }
    public function login(LoginRequest $request, LoginService $service){
        $data = $request->validated();
        $result = $service->login($request,$data);
        return $result;
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logout successfully'], Response::HTTP_OK);
    }
}
