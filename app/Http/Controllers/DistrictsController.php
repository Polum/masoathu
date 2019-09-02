<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\District;
use App\Http\Resources\DistrictsResource;
use DB;


class DistrictsController extends Controller
{ 
    public function index()
    {
        $districts = District::orderBy('id','asc')->paginate(10);
        //$districts = District::all();
        return DistrictsResource::collection($districts);
    } 
    public function indexAll()
    { 
        $districts = District::all();
        return DistrictsResource::collection($districts);
    }

    public function listAll()
    {
        $districts = District::all();
        return $districts;
    }
    public function show($id)
    {
        $district = District::findOrFail($id);
        return new DistrictsResource($district);
    }

    public function regions()
    {
        $regions = DB::table('regions')->get();
        return $regions;
    }

    public function districts()
    {
        $data = [];
        $districts = District::with('constituencies', 'constituencies.wards', 'constituencies.wards.centres')->get();
        foreach($districts as $district){
            $districtData = [];
            $districtData['id'] = $district->id;
            $districtData['district_name'] = $district->name;
            $districtData['constituencies'] = $district->constituencies->count();
            foreach($district->constituencies as $constituency){
                $districtData['wards'] = $constituency->wards->count();
                foreach($constituency->wards  as $ward){
                    $districtData['centres'] = $ward->centres->count();
                }
            }
            array_push($data, $districtData);
        }
        return view('results.districts', compact('data'));
    }

    public function district($id)
    {
        $data = [];
        $district = District::with('constituencies', 'constituencies.wards', 'constituencies.wards.centres')
                    ->where('id', $id)->get();
        foreach($district as $row){
            $data['id'] = $row->id;
            $data['district_name'] = $row->name;
            $data['constituencies'] = [];
            foreach($row->constituencies as $constituency){
                $constituencyData = [];
                $constituencyData['district_name'] = $row->name;
                $constituencyData["constituency_id"] = $constituency->id;
                $constituencyData["constituency_name"] = $constituency->name;
                $constituencyData["wards"] = $constituency->wards->count();
                foreach($constituency->wards as $ward){
                    $constituencyData["centres"] = $ward->centres->count();
                }
                array_push($data['constituencies'], $constituencyData);
            }
        }
        return redirect('district')->with(['district'=>$data]);
        // return $data;
    }
}
