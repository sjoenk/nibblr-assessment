<?php

namespace App\Helpers\Validators;

use App\Helpers\Validators\Validator;
use Illuminate\Http\Request;

class UserDataValidator extends Validator {


    public function validate(Request $request) {
        $validatedData = $request->validate([
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'bio' => 'max:300'
        ]);
        return $validatedData;
    }

}

