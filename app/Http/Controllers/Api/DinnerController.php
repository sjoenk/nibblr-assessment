<?php

namespace App\Http\Controllers\Api;

use App\Models\Dinner;
use App\Models\User;
use App\Models\Address;
use App\Http\Resources\DinnerResource;
use App\Http\Controllers\Controller;
use App\Helpers\Validators\DinnerValidator;
use Illuminate\Http\Request;

class DinnerController extends Controller
{

    public function __construct() {
        //$this->middleware('auth:api');
        $this->middleware('auth.dinnerhost', ['only' => ['update', 'destroy']]);
    }

 
    private function attachAddressToDinner(User $host, Dinner $dinner, Request $request) {
        $address = $host->address;
        if (isset($request["address"])) {
            $addressData = $request["address"];
            $address = Address::firstOrNew([
                'id' => $addressData['id']
            ], $addressData);
            $address->save();
        }
        $dinner->address()->associate($address);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DinnerResource::collection(Dinner::all()); 
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = (new DinnerValidator())->validate($request);

        $dinner = new Dinner($validatedData);
        $host = auth()->user();
        $dinner->host()->associate($host);
        $this->attachAddressToDinner($host, $dinner, $request);
        $dinner->save();

        return new DinnerResource($dinner);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dinner  $dinner
     * @return \Illuminate\Http\Response
     */
    public function show(Dinner $dinner)
    {
        return new DinnerResource($dinner);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dinner  $dinner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dinner $dinner)
    {
        $validatedData = (new DinnerValidator())->validate($request);

        $dinner->update($validatedData);
        $host = auth()->user();
        $this->attachAddressToDinner($host, $dinner, $request);
        $dinner->save();

        return new DinnerResource($dinner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dinner  $dinner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dinner $dinner)
    {
        $dinner->delete();
        return response(['success' => TRUE]);
    }
    
}
