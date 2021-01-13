<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Helpers\Validators\UserDataValidator;
use App\Helpers\Validators\AddressValidator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    
    public function __construct() {
        //$this->middleware('auth:api');
    }

    public function show() {
        return new UserResource($this->getUser());
    }

    public function update(Request $request) {
        $user = $this->getUser();
        $addressData = $request["address"];
        $validatedData = (new UserDataValidator())->validate($request);
        $user->update($validatedData);
        $user->address->update($addressData);
        return new UserResource($user);
    }













}
