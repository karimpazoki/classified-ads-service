<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Province;
use App\Traits\ResponseBuilder;
use App\Http\Resources\ProvinceResource;

class ProvinceController extends Controller
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
     * returns a list of all provinces' information
     *
     * @return App\Models\Province[]
     */
    public function index()
    {
        $countries = Province::all();
        return $this->success(['provinces' => ProvinceResource::collection($countries)]);
    }

    /**
     * Returns an province's information
     *
     * @param int province
     *
     * @return App\Models\Province
     */
    public function show($province)
    {
        $province = Province::findOrFail($province);
        return $this->success(['province' => new ProvinceResource($province)]);
    }
}
