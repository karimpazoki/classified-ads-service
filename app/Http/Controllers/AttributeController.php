<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Attribute;
use App\Traits\ResponseBuilder;
use DB;

class AttributeController extends Controller
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
     * returns a list of all attributes' information
     *
     * @return App\Models\Attribute[]
     */
    public function index()
    {
        $attributes = Attribute::with('items')->get();
        return $this->success(['attributes' => $attributes]);
    }

    /**
     * Returns an attribute's information
     *
     * @param int attribute
     *
     * @return App\Models\Attribute
     */
    public function show($attribute)
    {
        $attribute = Attrribute::with('items')->findOrFail($attribute);
        return $this->success(['attribute' => $attribute]);
    }

    /**
     * Stores new attribute's information
     *
     * @param Illuminate\Http\Request $request
     *
     * @return App\Models\Attribute
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255|',
            'field_type' => 'required|integer|exists:id,field_types',
            'category' => 'required|integer|exists:id,field_types',
        ]);

        DB::beginTransaction();
        try {
            $attribute = Attribute::create([
                "name" => $request->name,
                "field_type_id" => $request->field_type,
                "attributes_category_id" => $request->category,
            ]);
    
            $field_type_has_item = FieldType::find($field_type)->value('has_item');
            if($field_type_has_item) {
                $attribute->items()->save($request->items);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        return $this->success(['attribute' => Attribute::create($request->all())], "The attribute created successfully", Response::HTTP_CREATED);
    }

    /**
     * Updates an existing attribute's information
     *
     * @param Illuminate\Http\Request $request
     * @param int attribute
     *
     * @return App\Models\Attribute
     */
    public function update(Request $request, $attribute)
    {
        // update
    }

    /**
     * Removes an existing attribute
     *
     * @param int attribute
     *
     * @return App\Models\Attribute
     */
    public function delete($attribute)
    {
        DB::beginTransaction();
        try {
            $attribute = Attribute::findOrFail($attribute);
            $attribute->items->delete();
            $attribute->delete();
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
        }
        return $this->success(['attribute' => $attribute], "The '{$attribute}' attribute deleted successfully", Response::HTTP_OK);
    }
}
