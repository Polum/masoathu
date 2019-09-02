<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ward;
use App\Http\Resources\WardsResource;
use App\Http\Resources\WardsResource_;
use DB;

class WardsController extends Controller
{
    public function index($no)
    {
        $wards = null;
        if (!$no) {
            $wards = Ward::orderBy('id','asc')->paginate(10); 
        }elseif ($no=="all") {
           $wards = Ward::all();
        }elseif ($no=="max") {
            $wards = Ward::orderBy('v','desc')->first();
            return new WardsResource($updates);
        }elseif ($no=="min") {
            $wards = Ward::orderBy('v','asc')->first();
            return new WardsResource($updates);
        }else {
            $wards = Ward::orderBy('id','asc')->paginate($no); 
        } 
        return WardsResource::collection($wards);
    }  
    public function show($id)
    {
        $ward = Ward::findOrFail($id);
        return new WardsResource($ward);
    }
    public function index_($no)
    {
        $wards = null;
        if (!$no) {
            $wards = Ward::orderBy('id','asc')->paginate(10); 
        }elseif ($no=="all") {
           $wards = Ward::all();
        }elseif ($no=="max") {
            $wards = Ward::orderBy('v','desc')->first();
            return new WardsResource_($updates);
        }elseif ($no=="min") {
            $wards = Ward::orderBy('v','asc')->first();
            return new WardsResource_($updates);
        }else {
            $wards = Ward::orderBy('id','asc')->paginate($no); 
        } 
        return WardsResource_::collection($wards);
    }  
    public function show_($id)
    {
        $ward = Ward::findOrFail($id);
        return new WardsResource_($ward);
    }
    public function inConstituency($id)
    {  
        $haveWard = Ward::where('constituency_id',$id)->paginate(10); 
        return WardsResource::collection($haveWard);
    }
    public function store(Request $request)
    {
        $name = $request->input('name');
        $constituency_id = $request->input('constituency_id');
        $code = $request->input('code');
        if (!$name){
            return [
                "data"=>null,
                "message"=>["error"=>"name can not be null"]
            ];
        }else if (!$constituency_id){
            return [
                "data"=>null,
                "message"=>["error"=>"constituency_id can not be null"]
            ];
        }  
        $haveWard = Ward::where('name',$name)->get();  
        if (count($haveWard)!==0) {
            $data = new WardsResource($haveWard[0]); 
            return [
                "data"=>$data,
                "message"=>["error"=>"have already been added"]
            ];
        } else { 
            $ward = new Ward;
            $ward->name = $name;
            $ward->constituency_id = $constituency_id;
            $ward->code = $code?$code:"";
            if ($ward->save()) {
                $data = new WardsResource($ward);
                return [
                    "data"=>$data,
                    "message"=>["success"=>"ward successfully added"]
                ]; 
            }
        }  
    }  
    public function update(Request $request)
    {
        $name = $request->input('name');
        $id = $request->input('id');
        $constituency_id = $request->input('constituency_id');
        $ward = Ward::find($id);
        if (!$ward) {
           return ["message"=>["error"=>"ward not found. It might have been deleted"]];
        }
        $ward->name=$name;
        $ward->constituency_id = $constituency_id;
        if ($ward->save()) {
            $data = new WardsResource($ward);
            return [
                "data"=>$data,
                "message"=>["success"=>"ward successfully updated"]
            ]; 
        }
    } 
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $ward = Ward::find($id);
        if (!$ward) {
           return ["message"=>["error"=>"ward not found. It might have been deleted"]];
        }else{
           if ($ward->delete()) {
            $data = new WardsResource($ward);
            return [
                "data"=>$data,
                "message"=>["success"=>"ward successfully deleted"]
            ]; 
        } 
        }
    }
}
