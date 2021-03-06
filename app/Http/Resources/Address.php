<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
        return [
                'id' => $this->id,
                'country' => $this->country,
                'city' => $this->city,
                'state' => $this->state,
                'address' => $this->address,
                'status' => $this->status,
                
                
        ];
    }
}
