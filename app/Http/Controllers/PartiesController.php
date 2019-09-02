<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Party;
use App\Http\Resources\PartiesResource;
use DB;

class PartiesController extends Controller
{
    public function index()
    {
        $parties = Party::orderBy('id','asc')->paginate(10);
        //$parties = Party::all();
        return PartiesResource::collection($parties);
    } 
    public function indexAll()
    { 
        $parties = Party::all();
        return PartiesResource::collection($parties);
    }
    public function show($id)
    {
        $party = Party::findOrFail($id);
        return new PartiesResource($party);
    }
    public function store(Request $request)
    { 
        $name = $request->input('name'); 
        $short_name = $request->input('short_name'); 
        $haveParty = Party::where('name',$name)->get(); 
        if (count($haveParty)!==0) {
            // return 'have';
            $data = new PartiesResource($haveParty);
            return [
                "data"=>$data,
                "message"=>["error"=>"have already been added"]
            ];
        } else { 
            $party = new Party;
            $party->name = $name; 
            $party->short_name = $short_name;
            $party->code = ''; 
            $party->type = ''; 
            //return $party; 
            if ($party->save()) {
                $data = new PartiesResource($party);
                return [
                    "data"=>$data,
                    "message"=>["success"=>"Party successfully added"]
                ]; 
            }
        }  
    }  
    public function update(Request $request)
    {
        $id = $request->input('id'); 
        $name = $request->input('name');
        $short_name = $request->input('short_name'); 
        $party = Party::find($id);
        if (!$party) {
           return ["message"=>["error"=>"Party not found. It might have been deleted"]];
        }
        $party->name=$name; 
        $party->short_name = $short_name; 
        if ($party->save()) {
            $data = new PartiesResource($party);
            return [
                "data"=>$data,
                "message"=>["success"=>"Party successfully updated"]
            ]; 
        }
    } 
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $party = Party::find($id);
        if (!$party) {
           return ["message"=>["error"=>"Party not found. It might have been deleted"]];
        }else{
           if ($party->delete()) {
            $data = new PartiesResource($party);
            return [
                "data"=>$data,
                "message"=>["success"=>"Party successfully deleted"]
            ]; 
        } 
        }
    }
}
