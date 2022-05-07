<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Attribute;
use App\Traits\ResponseBuilder;
use App\Models\FieldType;
use Illuminate\Validation\Rule;
use App\Http\Resources\AttributeResource;
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
        $attributes = Attribute::all();
        return $this->success(['attributes' => AttributeResource::collection($attributes)]);
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
        $attribute = Attribute::findOrFail($attribute);
        return $this->success(['attribute' => new AttributeResource($attribute)]);
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
        $field_type = FieldType::find($request->field_type);
        $field_type_has_item = $field_type->has_item;

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'field_type' => 'required|integer|exists:field_types,id',
            'category' => 'required|integer|exists:attributes_categories,id',
            'items' => [
                Rule::requiredIf($field_type_has_item),
                'array',
                'min:2',
                'max:50',
            ],
            'items.*.item' => [
                Rule::requiredIf($field_type_has_item),
                'string',
                'max:255',
            ],
        ]);

        DB::beginTransaction();
        try {
            $attribute = Attribute::create([
                "name" => $request->name,
                "field_type_id" => $request->field_type,
                "attributes_category_id" => $request->category,
            ]);
            
            
            if($field_type_has_item) {
                $attribute->items()->createMany($request->items);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
        DB::commit();

        return $this->success(['attribute' => new AttributeResource($attribute)], "The attribute created successfully", Response::HTTP_CREATED);
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
        # code
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
            $attribute->items()->delete();
            $attribute->delete();
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
        }
        return $this->success(['attribute' => new AttributeResource($attribute)], "'{$attribute->name}' attribute deleted successfully", Response::HTTP_OK);
    }
}
