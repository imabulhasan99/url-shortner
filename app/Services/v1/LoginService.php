<?php

namespace App\Services\v1;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AuthenticateResource;
use Symfony\Component\HttpFoundation\Response;

class LoginService
{
    public function login( $request, array $data ){
        if( !Auth::attempt($data) ) {
            return response()->json(['message'  =>'Login Failed'],Response::HTTP_UNAUTHORIZED);
        }
        $user = $request->user();
        $token = $user->tokens()->delete();
        $token = $user->createToken( 'login-token', expiresAt: now()->addHours(2) )->plainTextToken;
        $user = $user->only('id','name','username','email');
        return AuthenticateResource::make([
            'message'   => 'Login successfull',
            'token'=> $token,
            'user'=> $user,
        ]);
    }
}
