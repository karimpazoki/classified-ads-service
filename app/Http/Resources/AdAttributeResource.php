<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdAttributeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "attribute" => $this->attribute->name,
            "value" => $this->value,
        ];
    }
}
