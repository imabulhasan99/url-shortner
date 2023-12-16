<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Resources\AuthenticateResource;
use Symfony\Component\HttpFoundation\Response;

class RegistrationService
{
    public function register(array $data){
        $data['username'] = Str::random(5);
        $emailExists = User::where("email", $data["email"])->exists();
        if($emailExists){
            return response()->json(['message'  => 'This email already in our database'],Response::HTTP_BAD_REQUEST);
        }
        $user = User::create($data);
        $token = $user->createToken( 'signup-token', expiresAt: now()->addHours(2) )->plainTextToken;
        $user =  $user->only('id','name','email','username');
        return AuthenticateResource::make(
            [
                'message'   => 'Registration successfull',
                'user' => $user, 
                'token' => $token,
            ]);
    }
}
