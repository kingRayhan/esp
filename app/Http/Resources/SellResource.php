<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellResource extends JsonResource
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
            'sell_id' => $this->id,
            'product_name' => $this->product->name,
            'quantity' => $this->quantity,
            'sell_unit_price' => $this->sell_price,
            'total_sell_price' => $this->quantity * $this->sell_price,
            'doctor' => $this->doctor,
            'date' => $this->slip['bill_date'],
            // 'date' => $this->created_at->format('d/m/Y'),
            // 'time' => $this->created_at->format('g:i:s a')
        ];
    }
}
