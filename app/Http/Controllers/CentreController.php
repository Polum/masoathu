<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Centre;
use App\Ward;
use App\District;
use App\Http\Resources\CentresResource;

class CentreController extends Controller
{

    public function index()
    {
        $centres = Centre::orderBy('id','asc')->paginate(10);
        //$centres = Centre::all();
        return CentresResource::collection($centres);
    } 
    public function indexAll()
    { 
        $centres = Centre::all();
        // return CentresResource::collection($centres);
        return response()->json(['data'=>$centres]);
    } 
    public function listAll()
    { 
        $centres = Centre::all();
        return $centres;
    } 
    public function show($id)
    {
        $centre = Centre::findOrFail($id);
        return new CentresResource($centre);
    }
    
    public function centre($id)
    {
        $districtData = [];
        $centre = Centre::with('ward', 'ward.constituency', 'ward.constituency.district')
        ->where('id', $id)->first();

        $districtData["district"] = $centre->ward->constituency->district->name;
        $districtData["constituency"] = $centre->ward->constituency->name;
        $districtData["ward"] = $centre->ward->name;
        $districtData["centre_name"] = $centre["name"];
        $districtData["centre_no"] = $centre["code"];
        $districtData["centre_id"] = $centre["id"];

        return $districtData;
    }
    
    public function centres()
    {
        $response = [];
        $districts = District::with('constituencies', 'constituencies.wards', 'constituencies.wards.centres')
                ->WHERE('region_id', Auth::user()->region_id)->get()->toArray();

        foreach($districts as $district){
            $districtData = [];
            foreach($district["constituencies"] as $constituency){
                foreach($constituency["wards"] as $ward){
                    foreach($ward["centres"] as $centre){
                        $districtData["district"] = $district["name"];
                        $districtData["constituency"] = $constituency["name"];
                        $districtData["ward"] = $ward["name"];
                        $districtData["centre_name"] = $centre["name"];
                        $districtData["centre_no"] = $centre["code"];
                        $districtData["centre_id"] = $centre["id"];
                        array_push($response, $districtData);
                    }
                }
            } 
        }


        return $response;
    }

    public function centresAll()
    {
        return view('results.centres');
    }
}
