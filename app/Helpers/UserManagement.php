<?php

namespace App\Helpers\UserManagement;

use App\Models\User;

trait UserManagement {

    protected function getUserId() {
        return 1;
    }

    protected function getUser() {
        return User::findOrFail($this->getUserId());
    }

}