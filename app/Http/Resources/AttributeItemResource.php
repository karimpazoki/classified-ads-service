<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'item' => $this->item
        ];
    }
}
