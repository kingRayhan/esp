<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'product_id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'category' => isset($this->category) ? $this->category->name : null,
            'category_id' => isset($this->category) ? $this->category->id : null,
            'barcode' => str_pad($this->id, 8, '0', STR_PAD_LEFT)
        ];
    }
}
