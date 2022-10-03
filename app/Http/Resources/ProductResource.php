<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'sku'        => $this->sku,
            'name'       => $this->name,
            'price'      => $this->price,
            'categories' => CategoryResource::collection($this->categories),
            // Following the original proposal this relationship should be displayed just like this:
            // 'category'   => $this->category->name,
        ];
    }
}
