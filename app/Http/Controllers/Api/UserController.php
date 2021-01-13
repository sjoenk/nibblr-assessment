<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:api');
    }

    private function getUserId() {
        return auth()->user()->id;
    }

    public function show() {
        return new UserResource(User::findOrFail(getUserId()));
    }

    public function update($request) {
        $user = User::findOrFail(getUserId());
        $user->name = $request->name;
        $user->save();
        return new UserResource($user);
    }













}
