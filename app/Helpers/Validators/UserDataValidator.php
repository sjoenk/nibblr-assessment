<?php

namespace App\Helpers\Validators;

use App\Helpers\Validators\Validator;
use Illuminate\Http\Request;

class UserDataValidator extends Validator {


    public function validate(Request $request) {
        $validatedData = $request->validate([
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'bio' => 'max:300',
            'email' => 'email|unique:users,email,'.auth()->id(),
            'password' => 'confirmed|min:6',
            'address.city' => 'required_with:address|string|max:255',
            'address.postal_code' => 'required_with:address|string|max:255',
            'address.street' => 'required_with:address|string|max:255',
            'address.number' => 'required_with:address|string|max:255',
        ]);
        return $validatedData;
    }

}

