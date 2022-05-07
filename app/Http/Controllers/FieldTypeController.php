<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\FieldType;
use App\Traits\ResponseBuilder;
use App\Http\Resources\FieldTypeResource;

class FieldTypeController extends Controller
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
     * returns a list of all field_types' information
     *
     * @return App\Models\FieldType[]
     */
    public function index()
    {
        $field_types = FieldType::all();
        return $this->success(['field_types' => FieldTypeResource::collection($field_types)]);
    }

    /**
     * Returns an field_type's information
     *
     * @param int field_type
     *
     * @return App\Models\FieldType
     */
    public function show($field_type)
    {
        $field_type = FieldType::findOrFail($field_type);
        return $this->success(['field_type' => new FieldTypeResource($field_type)]);
    }
}
