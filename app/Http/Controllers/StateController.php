<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\State as StateResource;


class StateController extends Controller
{
    

     /**
     * Display a State of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function states($id)
    {
       
        //return StateResource::collection(State::where('country_id',$id));
         
          $states = DB::table('states')->select('id','name')->where('country_id',$id)->get(); 
          return ['data' => $states];
       
    }
}
