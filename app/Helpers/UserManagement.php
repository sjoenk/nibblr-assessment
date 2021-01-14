<?php

namespace App\Helpers;

use App\Models\User;

trait UserManagement {

    protected function getUserId() {
        return 2;
    }

    protected function getUser() {
        return User::findOrFail($this->getUserId());
    }

}