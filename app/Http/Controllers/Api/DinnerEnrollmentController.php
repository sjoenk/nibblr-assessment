<?php

namespace App\Http\Controllers\Api;

use App\Models\Dinner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;

class DinnerEnrollmentController extends Controller
{
    
    public function registerEnrollment(Dinner $dinner) {
        $inThePast = $dinner->isInThePast();
        $placesAvailable = $dinner->hasPlacesAvailable();
        $userId = $this->getUserId();
        $isHost = $dinner->host->id == $userId;
        $isAlreadyGuest = $dinner->guests->contains($userId);

        if ($inThePast) {
            return response(["message" => "dinner is in the past"]);
        } else if (!$placesAvailable) {
            return response(["message" => "there are no places available"]);
        } else if ($isHost) {
            return response(["message" => "you are the host"]);
        } else if ($isAlreadyGuest) {
            return response(["message" => "you are already a guest"]);
        }

        $dinner->guests()->attach($userId);
        
        return response(["message" => "you are now enrolled for this dinner"]);
    }

    public function cancelEnrollment(Dinner $dinner) {
        $userId = $this->getUserId();
        $isAlreadyGuest = $dinner->guests->contains($userId);
        if (!$isAlreadyGuest) {
            return response(["message" => "you were never a guest"]);
        }

        $dinner->guests()->detach($userId);

        return response(["message" => "your enrollment is cancelled"]);
    }


}
