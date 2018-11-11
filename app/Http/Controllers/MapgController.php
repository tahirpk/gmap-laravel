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


    public function mindex()
    {
             
        $addresses= Address::select('address','status')->where('status','Active')->orderBy('id','DESC')->paginate(6);
       
        foreach($addresses as $key=>$obj)
        {
            $response = \GoogleMaps::load('geocoding')
            ->setParam (['address' =>$obj->address])
            ->get();
            
            $data_map=json_decode($response);
            $data_map=$data_map->results;
                        
            if(!empty($data_map)) 
            {
                $address = explode(',', $data_map[0]->formatted_address);
                $data_map = $data_map[0]->geometry->location;
                $lat_lng=$data_map->lat.','.$data_map->lng;
                $locations[]=[$address[0],$data_map->lat,$data_map->lng];

            }          
            
        }
       
        return view('welcome',['addresses'=>$addresses,'locations'=>json_encode($locations)]); 
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