<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributesCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'parentId' => $this->parent_id,
            'children' =>  $this->when($this->children->count() > 0, AttributesCategoryResource::collection($this->children))
            // TODO: add ralated attributes
        ];
    }
}
