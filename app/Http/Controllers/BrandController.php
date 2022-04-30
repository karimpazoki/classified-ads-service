<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Brand;
use App\Traits\ResponseBuilder;

class BrandController extends Controller
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
     * returns a list of all brands' information
     *
     * @return App\Models\Brand[]
     */
    public function index()
    {
        return $this->success(['brands' => Brand::all()]);
    }

    /**
     * Returns an brand's information
     *
     * @param int brand
     *
     * @return App\Models\Brand
     */
    public function show($brand)
    {
        return $this->success(['brand' => Brand::findOrFail($brand)]);
    }

    /**
     * Stores new brand's information
     *
     * @param Illuminate\Http\Request $request
     *
     * @return App\Models\Brand
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);

        return $this->success(['brand' => Brand::create($request->all())], "The brand created successfully", Response::HTTP_CREATED);
    }

    /**
     * Updates an existing brand's information
     *
     * @param Illuminate\Http\Request $request
     * @param int brand
     *
     * @return App\Models\Brand
     */
    public function update(Request $request, $brand)
    {
        $this->validate($request,[
            'name' => 'string|max:255',
        ]);

        $brand = Brand::findOrFail($brand);
        $brand->fill($request->all());
        $brand->save();
        return $this->success(['brand' => $brand], "The brand updated successfully", Response::HTTP_OK);
    }

    /**
     * Removes an existing brand
     *
     * @param int brand
     *
     * @return App\Models\Brand
     */
    public function delete($brand)
    {
        $brand = Brand::findOrFail($brand);
        $brand->delete();
        return $this->success(['brand' => $brand], "The '{$brand}' brand deleted successfully", Response::HTTP_OK);
    }
}
