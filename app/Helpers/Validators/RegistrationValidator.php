<?php

namespace App\Helpers\Validators;

use App\Helpers\Validators\Validator;
use Illuminate\Http\Request;

class RegistrationValidator extends Validator {

    public function validate(Request $request) {
        $validatedData = $request->validate([
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'bio' => 'max:300',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:6',
            'address.city' => 'required|string|max:255',
            'address.postal_code' => 'required|string|max:255',
            'address.street' => 'required|string|max:255',
            'address.number' => 'required|string|max:255',
        ]);
        return $validatedData;
    }

}
