<?php

namespace App\Helpers\Validators;

use Illuminate\Http\Request;

abstract class Validator {

    abstract public function validate(Request $request);

}