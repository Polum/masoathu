<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Constituency;
use App\District;
use App\Http\Resources\ConstituenciesResource;
use DB;

class ConstituenciesController extends Controller
{
    public function index()
    {
        $constituencies = Constituency::orderBy('id','asc')->paginate(10);
        //$constituencies = Constituency::all();
        return ConstituenciesResource::collection($constituencies);
    } 
    public function indexAll()
    { 
        $constituencies = Constituency::all();
        return ConstituenciesResource::collection($constituencies);
    }
    public function listAll()
    { 
        $constituencies = Constituency::all();
        return $constituencies;
    }
    public function show($id)
    {
        $constituency = Constituency::findOrFail($id);
        return new ConstituenciesResource($constituency);
    }

    public function constituencies()
    {
        // $data = [];
        // $constituencies = Constituency::with('wards', 'wards.centres')->get();
        // foreach($constituencies as $constituency){
        //     $constituencyData = [];
        //     $constituencyData['id'] = $constituency->id;
        //     $constituencyData['constituency_name'] = $constituency->name;
        //     $constituencyData['wards'] = $constituency->wards->count();
        //     foreach($constituency->wards as $ward){
        //         $constituencyData['wards'] = $ward->centres->count();
        //     }
        //     array_push($data, $constituencyData);
        // }
        return view('results.constituencies');
    }

    public function constituency($id)
    {
        $data = [];
        $constituency = Constituency::with('districts', 'wards', 'wards.centres')
                    ->where('id', $id)->get();
        foreach($constituency as $row){
            $data['id'] = $row->id;
            $data['name'] = $row->name;
            $data['wards'] = [];
            foreach($row->wards as $ward){
                $wardData = [];
                $wardData['ward_id'] = $ward->id;
                $wardData['district_name'] = $row->districts->name;
                $wardData['constituency_name'] = $row->name;
                $wardData['ward_name'] = $ward->name;
                $wardData["centres"] = $ward->centres->count();
                array_push($data['wards'], $wardData);
            }
        }
        return redirect('constituency')->with(['constituency'=>$data]);
        // return $data;
    }
}
