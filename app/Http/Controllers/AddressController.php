<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Address;
use App\country;
use App\State;
use App\City;
use App\Http\Resources\Address as AddressResource;

class AddressController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $data = AddressResource::collection(Address::orderBy('id','DESC')->paginate(6));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    
        $country = DB::table('countries')->select('id','name')->where('id',$request->get('country'))->get();
        $state = DB::table('states')->select('id','name')->where('id',$request->get('state'))->get();
        $city = DB::table('cities')->select('id','name')->where('id',$request->get('city'))->get();
        /*
            only this work at window installed server; xammp, wamp etc
            $country=Country::find($request->get('country'));
            $state = State::find($request->get('state'));
            $city = City::find($request->get('city'));
        */
        $address = new Address;
        $address->address = $request->get('address');
        $address->country = $country[0]->name;
        $address->city = $city[0]->name;
        $address->state = $state[0]->name;
        $address->status = $request->get('status');
        $address->save(); //Address::create($request->all());
      
        return new AddressResource($address);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $address =Address::find($id);

         return new AddressResource($address);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $address =Address::find($id);
         $address->update($request->all());
        return new AddressResource($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $address =Address::find($id);
         $address->delete();
         return new AddressResource($address);
    }


     /**
     * Display a City of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cities($id)
    {

         //$state=$request->get('state');
        //return CityResource::collection(City::where('state_id',$state));
         $cities = DB::table('cities')->select('id','name')->where('state_id',$id)->get(); 
          return ['data' => $cities];
    }
}
