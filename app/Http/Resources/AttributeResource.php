<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\FieldTypeResource;

class AttributeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'fieldType' => new FieldTypeResource($this->fieldType),
            'items' =>  $this->when($this->items->count() > 0, AttributeItemResource::collection($this->items))
        ];
    }
}
