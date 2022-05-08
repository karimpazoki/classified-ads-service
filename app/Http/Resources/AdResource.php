<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\{
    UserResource,
    CategoryResource,
    AdAttributeResource,
};

class AdResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => new CategoryResource($this->category),
            'user' => new UserResource($this->user),
            'price' => $this->price,
            'is_enable' => $this->is_enable,
            'is_confirmed' => $this->is_confirmed,
            "attributes" => AdAttributeResource::collection($this->attributes)
        ];
    }
}
