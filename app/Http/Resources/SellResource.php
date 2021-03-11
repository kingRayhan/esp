<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'sell_id' => $this->id,
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'price' => $this->sell_price,
            'date' => $this->slip['bill_date']->toDateString()
        ];
    }
}
