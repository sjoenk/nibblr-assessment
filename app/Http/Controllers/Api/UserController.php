<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

use App\Helpers\Validators\UserDataValidator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    
    public function __construct() {
        //$this->middleware('auth:api');
    }

    private function getUserId() {
        //return auth()->user()->id;
    }

    public function show() {
        return new UserResource(User::findOrFail($this->getUserId()));
    }

    public function update(Request $request) {
        $user = User::findOrFail($this->getUserId());
        $validatedData = (new UserDataValidator())->validate($request);
        $user["first_name"] = $request["first_name"];
        $user["last_name"] = $request["last_name"];
        $user["bio"] = $request["bio"];
        $user->save();
        return new UserResource($user);
    }













}