<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use DB;
use App\Constituency;
use App\Ward;
use App\Centre;
use App\Result;
use App\Candidate;
use App\Party;

class DistrictsResource extends Resource
{ 
    public function toArray($request)
    {
        $candidates = Candidate::all();
        $constituencies = Constituency::where('district_id',$this->id)->get(); 
        $wards=[];
        foreach ($constituencies as $key => $value) {
            $wd=Ward::where('constituency_id',$value->id)->get();
            foreach ($wd as $key => $value) { 
                array_push($wards,$value);  
            }
        }
        $centres=[];
        foreach ($wards as $key => $val) {
            $ct=Centre::where('ward_id',$val->id)->get();
            foreach ($ct as $key => $value) {
                array_push($centres,$value);  
            }
             
        }
        //looping through results
        $results = Result::where('district_id',$this->id)->get();
        $totalResults =0;
        if (count($results)!==0) {
            foreach ($results as $item) {
                $value = $item->value;
                $totalResults = $totalResults+$value;
            }
        }
        
        //looping through candidate 
        $newCandidates=[];
        foreach ($candidates as $key => $candidate) {
            $totalResultsCandidate =0;
            $resultsCandidate = Result::where([
                ['candidate_id','=',$candidate->id],['district_id','=',$this->id]
            ])->get(); 
            if (count($resultsCandidate)!==0) {
                foreach ($resultsCandidate as $item) {
                    $value = $item->value;
                    $totalResultsCandidate = $totalResultsCandidate+$value; 
                }
            }
            $party = Party::find($candidate->party_id);
            array_push($newCandidates,[
                'id'=> $candidate->id,
                'name'=> $candidate->name, 
                'party_id'=>$party->id,
                'party_name'=>$party->name,
                'results'=>$totalResultsCandidate
            ]);
        }

        return [
            'id'=> $this->id,
            'region_id'=> $this->region_id,
            'name'=> $this->name,  
            'constituencies'=> count($constituencies), 
            'wards'=> count($wards), 
            'centres'=>count($centres),
            'results'=>$totalResults,
            'candidates'=>$newCandidates
        ];
    }
}
