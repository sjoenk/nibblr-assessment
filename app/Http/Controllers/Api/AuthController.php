<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\Validators\RegistrationValidator;
use App\Helpers\Validators\LoginValidator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request) 
    {
        
        $validatedData = (new RegistrationValidator())->validate($request);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request) 
    {
        $loginData = (new LoginValidator())->validate($request);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }
}
