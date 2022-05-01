<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Category;
use App\Traits\ResponseBuilder;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
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
     * returns a list of all categories' information
     *
     * @return App\Models\Category[]
     */
    public function index()
    {
        $categories = Category::where('parent_id', null)
            ->with('children')
            ->get();
        return $this->success(["categories" => CategoryResource::collection($categories)]);
    }

    /**
     * Returns an category's information
     *
     * @param int category
     *
     * @return App\Models\Category
     */
    public function show($category)
    {
        return $this->success([
            "category" => new CategoryResource(
                Category::with('children')
                    ->findOrFail($category)
            ),
        ]);
    }

    /**
     * Stores new category's information
     *
     * @param Illuminate\Http\Request $request
     *
     * @return App\Models\Category
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'parent_id' => 'integer|exists:categories,id',
        ]);

        return $this->success([
                "category" => new CategoryResource(Category::create($request->all())),
            ], 
            "The category created successfully", 
            Response::HTTP_CREATED
        );
    }

    /**
     * Updates an existing category's information
     *
     * @param Illuminate\Http\Request $request
     * @param int category
     *
     * @return App\Models\Category
     */
    public function update(Request $request, $category)
    {
        $this->validate($request, [
            'name' => 'string|max:255',
            'parent_id' => 'integer|exists:categories,id',
        ]);

        $category = Category::findOrFail($category);
        $category->fill($request->all());
        $category->save();
        return $this->success([
                "category" => new CategoryResource($category)
            ], 
            "The category updated successfully", 
            Response::HTTP_OK
        );
    }

    /**
     * Removes an existing category
     *
     * @param int category
     *
     * @return App\Models\Category
     */
    public function delete($category)
    {
        $category = Category::findOrFail($category);
        $category->delete();
        return $this->success([
                "category" => new CategoryResource($category)
            ], 
            "'{$category->name}' category deleted successfully", 
            Response::HTTP_OK
        );
    }
}
