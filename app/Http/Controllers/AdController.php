<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Ad;
use App\Traits\ResponseBuilder;
use App\Http\Resources\AdResource;
use Auth;

class AdController extends Controller
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
     * returns a list of all ads' information
     *
     * @return App\Models\Ad[]
     */
    public function index()
    {
        return $this->success(['ads' => AdResource::collection(Ad::all())]);
    }

    /**
     * Returns an ad's information
     *
     * @param int ad
     *
     * @return App\Models\Ad
     */
    public function show($ad)
    {
        return $this->success(['ad' => new AdResource(Ad::findOrFail($ad))]);
    }

    /**
     * Stores new ad's information
     *
     * @param Illuminate\Http\Request $request
     *
     * @return App\Models\Ad
     */
    public function store(Request $request)
    {
    }

    /**
     * Updates an existing ad's information
     *
     * @param Illuminate\Http\Request $request
     * @param int ad
     *
     * @return App\Models\Ad
     */
    public function update(Request $request, $ad)
    {
    }

    /**
     * Removes an existing ad
     *
     * @param int ad
     *
     * @return App\Models\Ad
     */
    public function delete($ad)
    {
        $ad = Ad::findOrFail($ad);
        $ad->delete();
        return $this->success(['ad' => new AdResource($ad)], "'{$ad->title}' ad deleted successfully", Response::HTTP_OK);
    }
}
