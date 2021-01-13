<?php

namespace App\Helpers\Validators;

use App\Helpers\Validators\Validator;
use Illuminate\Http\Request;

class DinnerValidator extends Validator {


    public function validate(Request $request) {
        $dinnerData = $request->validate([
            'start' => 'required',
            'end' => 'required',
            'title' => 'required',
            'description' => 'max:400',
            'max_members' => 'required'
        ]);
        return $dinnerData;
    }

}
