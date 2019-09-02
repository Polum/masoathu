<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidate;
use App\Party;
use App\Http\Resources\PartiesResource;
use App\Result;
use App\Http\Resources\ResultsResource;
use App\Http\Resources\CandidatesResource;
use DB;

class ResultsController extends Controller
{
    public function index()
    {
        return view('results.index');
    }

    public function listed()
    {
        $results = Result::orderBy('id','asc')->paginate(10);
        return ResultsResource::collection($results);
    } 
    public function all()
    {
        $results = Result::all();
        return ResultsResource::collection($results);
    } 
    public function show($id)
    {
        $result = Result::findOrFail($id);
        return new ResultsResource($result);
    }
    public function inCentre($id)
    {  
        $haveResult = Result::where('centre_id',$id)->paginate(10); 
        return ResultsResource::collection($haveResult);
    }

    public function create()
    {
        $candidates = Candidate::all();
        return view('results.create', compact('candidates'));
    }
    public function resultNew(Request $request)
    {
        $result = [];
        $result["cashedId"] = 0;
        $result["observer_id"] = 2;
        $result["region_id"] = $request->region_id;
        $result["district_id"] = $request->district_id;
        $result["constituency_id"] = $request->constituency_id;
        $result["ward_id"] = $request->ward_id;
        $result["centre_id"] = $request->centre_id;

        foreach($request->all() as $key => $value){
            if(is_int($key) && $value != null){
                $result["candidate_id"] = $key;
                $result["value"] = $value;

                $existing = Result::where('centre_id', $result["centre_id"])->where('candidate_id', $result["candidate_id"])->first();
                if(empty($existing)){
                    DB::table('results')->insert($result);
                }else{
                    $existing->value = $value;
                    $existing->save();
                }
            }
        }
        
        return redirect('add-results');
    }
    public function store(Request $request)
    {
        $cashedId = $request->input('cashedId')? $request->input('cashedId'): 0;
        $region_id = $request->input('region_id');
        $district_id = $request->input('district_id');
        $constituency_id = $request->input('constituency_id');
        $ward_id = $request->input('ward_id');
        $centre_id = $request->input('centre_id');
        $candidate_id = $request->input('candidate_id');
        $observer_id = $request->input('observer_id')? $request->input('observer_id'): 0;
        $value = $request->input('value')? $request->input('value'): 0;

        $result = new Result;
        $result->cashedId = $cashedId;
        $result->region_id = $region_id;
        $result->district_id = $district_id;
        $result->constituency_id = $constituency_id;
        $result->ward_id = $ward_id;
        $result->centre_id = $centre_id;
        $result->candidate_id = $candidate_id;
        $result->observer_id = $observer_id;
        $result->value = $value;

        $existing = Result::where('centre_id', $result->centre_id)->where('candidate_id', $result->candidate_id)->first();
        if(empty($existing)){
            $result->save();
            $data = new ResultsResource($result);
            return [
                "data"=>[$data],
                "message"=>["success"=>"result successfully added"]
            ];
        }else{
            $existing->value = $value;
            $existing->save();
        }
    }  
    public function update(Request $request)
    { 
        $id = $request->input('id');
        $cashedId = $request->input('cashedId');
        $region_id = $request->input('region_id');
        $district_id = $request->input('district_id');
        $constituency_id = $request->input('constituency_id');
        $ward_id = $request->input('ward_id');
        $centre_id = $request->input('centre_id');
        $candidate_id = $request->input('candidate_id');
        $observer_id = $request->input('observer_id');
        $value = $request->input('value');
        $result = Result::find($id);
        if (!$result) {
           return ["message"=>["error"=>"result not found. It might have been deleted"]];
        }
        $result->cashedId = $cashedId;
        $result->region_id = $region_id;
        $result->district_id = $district_id;
        $result->constituency_id = $constituency_id;
        $result->ward_id = $ward_id;
        $result->centre_id = $centre_id;
        $result->candidate_id = $candidate_id;
        $result->observer_id = $observer_id;
        $result->value = $value;
        if ($result->save()) {
            $data = new ResultsResource($result);
            return [
                "data"=>[$data],
                "message"=>["success"=>"result successfully updated"]
            ]; 
        }
    } 

    public function candidates()
    {
        $candidates = Candidate::orderBy('name','asc')->paginate(10);
        return CandidatesResource::collection($candidates);
    }
    public function candidatesAll()
    { 
        $parties = Party::all();
        return PartiesResource::collection($parties);
    }
}
