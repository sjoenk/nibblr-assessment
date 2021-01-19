<?php

namespace App\Helpers\Validators;

use App\Helpers\Validators\Validator;
use Illuminate\Http\Request;

class DinnerValidator extends Validator {


    public function validate(Request $request) {
        $dinnerData = $request->validate([
            'start' => 'required|date|date_format:Y-m-d H:i:s',
            'end' => 'required|date|date_format:Y-m-d H:i:s',
            'title' => 'required|string',
            'description' => 'max:400|string',
            'max_members' => 'required|numeric'
        ]);
        return $dinnerData;
    }

}
