<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SlipResource extends JsonResource
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
            'id' => $this->id,
            'customer_name' => $this->customer_name,
            'customer_age' => $this->customer_age,
            'customer_gender' => $this->customer_gender,
            'bill_date' => $this->bill_date,
            'paid' => $this->paid,
            'discount' => $this->discount ? $this->discount : 0,
            'bills' => $this->orders->sum('sell_price'),
            'net_bills' => $this->orders->sum('sell_price') - $this->discount,
            'doctor' => $this->doctor,
            'tests' => $this->orders,
        ];
    }
}
