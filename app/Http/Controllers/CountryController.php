<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Http\Resources\Country as CountryResource;

class CountryController extends Controller
{
     /**
     * Display a Country of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function countries()
    {
    	
        return CountryResource::collection(Country::all());
    }
}
