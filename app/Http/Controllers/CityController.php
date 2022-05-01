<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\city;
use App\Traits\ResponseBuilder;
use App\Http\Resources\CityResource;

class CityController extends Controller
{
    use ResponseBuilder;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * returns a list of all cities' information
     *
     * @return App\Models\City[]
     */
    public function index()
    {
        $cities = City::all();
        return $this->success(['cities' => CityResource::collection($cities)]);
    }

    /**
     * Returns an city's information
     *
     * @param int city
     *
     * @return App\Models\City
     */
    public function show($city)
    {
        $city = City::findOrFail($city);
        return $this->success(['city' => new CityResource($city)]);
    }
}
