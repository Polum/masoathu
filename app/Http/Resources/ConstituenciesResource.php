<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use DB;
use App\District;
use App\Ward;
use App\Centre;
use App\Result;
use App\Candidate;
use App\Party;

class ConstituenciesResource extends Resource
{
     
    public function toArray($request)
    {
        $candidates = Candidate::all();
        $district = District::find($this->district_id);
        $wards = Ward::where('constituency_id',$this->id)->get();
        $centres=[];
        foreach ($wards as $key => $val) {
            $ct=Centre::where('ward_id',$val->id)->get();
            foreach ($ct as $key => $value) {
                array_push($centres,$value);  
            }
             
        }
        //looping through results
        $results = Result::where('constituency_id',$this->id)->get();
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
                ['candidate_id','=',$candidate->id],['constituency_id','=',$this->id]
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
            'name'=> $this->name,  
            'district_id'=> $district->id, 
            'district_name'=> $district->name, 
            'wards'=> count($wards), 
            'centres'=>count($centres),
            'results'=>$totalResults,
            'candidates'=>$newCandidates
        ];
    }
}
