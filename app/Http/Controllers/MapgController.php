<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
class MapgController extends Controller
{
    
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
	   
	  
 		$addresses= Address::orderBy('id','DESC')->paginate(6);
        return view('gmap',['addresses'=>$addresses]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_map(Request $request)
    {
    	
      $address=Address::find($request->id);
      $address=$address->address;
      $response = \GoogleMaps::load('geocoding')
			->setParam (['address' =>$address])
	 		->get();
      $data_map=json_decode($response);
 	  $data_map=$data_map->results;
 	  $data_map = $data_map[0]->geometry->location;
 	  $lat_lng=$data_map->lat.','.$data_map->lng;
   
       
      return $lat_lng;
    }

    public function search(Request $request)
    {
        $search=$request->get('search');
        $addresses=Address::where('address','like','%'.$search.'%')->paginate(6);
        return view('gmap',['addresses'=>$addresses]);
    }
}