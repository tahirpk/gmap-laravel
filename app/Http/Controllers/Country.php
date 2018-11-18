<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Country extends Controller
{
    
	 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
        return [
                'id' => $this->id,
                'name' => $this->name,
                
                
                
        ];

}
