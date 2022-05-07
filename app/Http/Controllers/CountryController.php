<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Country;
use App\Traits\ResponseBuilder;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
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
     * returns a list of all countries' information
     *
     * @return App\Models\Country[]
     */
    public function index()
    {
        $countries = Country::all();
        return $this->success(['countries' => CountryResource::collection($countries)]);
    }

    /**
     * Returns an country's information
     *
     * @param int country
     *
     * @return App\Models\Country
     */
    public function show($country)
    {
        $country = Country::findOrFail($country);
        return $this->success(['country' => new CountryResource($country)]);
    }
}
