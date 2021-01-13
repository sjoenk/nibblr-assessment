<?php

namespace App\Http\Controllers\DinnerController;

use App\Dinner;
use App\Http\Resources\DinnerResource;
use App\Helpers\Validators\DinnerValidator;
use Illuminate\Http\Request;

class DinnerController extends Controller
{

    public function __construct() {
        //$this->middleware('auth:api');
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
        (new DinnerValidator())->validate($request);

        $dinner = new Dinner($request);
        $host = $this->getUser();

        $address = $host->address;
        if (isset($request["address"])) {
            $address = new Address($addressData);
            $address->save();
        }


        $dinner->host()->associate($host);
        $dinner->address()->associate($address);

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
        //
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
