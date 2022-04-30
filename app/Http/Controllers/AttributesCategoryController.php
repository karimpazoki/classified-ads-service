<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AttributesCategory;
use App\Traits\ResponseBuilder;

class AttributesCategoryController extends Controller
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
     * returns a list of all attributes categories' information
     *
     * @return App\Models\AttributesCategory[]
     */
    public function index()
    {
        $attributes_categories = AttributesCategory::where('parent_id', null)
            ->with('children')
            ->get();
        return $this->success(["attributesCategories" => $attributes_categories]);
    }

    /**
     * Returns an attributes category's information
     *
     * @param int attributes category
     *
     * @return App\Models\AttributesCategory
     */
    public function show($attributes_category)
    {
        return $this->success(["attributesCategory" => AttributesCategory::with('children')->findOrFail($attributes_category)]);
    }

    /**
     * Stores new attributes category's information
     *
     * @param Illuminate\Http\Request $request
     *
     * @return App\Models\AttributesCategory
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'parent_id' => 'integer|exists:attributes_categories,id',
        ]);

        return $this->success(["attributesCategory" => AttributesCategory::create($request->all())], "The attributes category created successfully", Response::HTTP_CREATED);
    }

    /**
     * Updates an existing attributes category's information
     *
     * @param Illuminate\Http\Request $request
     * @param int attributes category
     *
     * @return App\Models\AttributesCategory
     */
    public function update(Request $request, $attributes_category)
    {
        $this->validate($request, [
            'name' => 'string|max:255',
            'parent_id' => 'integer|exists:attributes_categories,id',
        ]);

        $attributes_category = AttributesCategory::findOrFail($attributes_category);
        $attributes_category->fill($request->all());
        $attributes_category->save();
        return $this->success(["attributesCategory" => $attributes_category], "The attributes category updated successfully", Response::HTTP_OK);
    }

    /**
     * Removes an existing attributes category
     *
     * @param int attributes category
     *
     * @return App\Models\AttributesCategory
     */
    public function delete($attributes_category)
    {
        $attributes_category = AttributesCategory::findOrFail($attributes_category);
        $attributes_category->delete();
        return $this->success(["attributesCategory" => $attributes_category], "The '{$attributes_category->name}' attributes category deleted successfully", Response::HTTP_OK);
    }
}
