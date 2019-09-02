<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use DB;
use App\District;
use App\Constituency;
use App\Centre;
use App\Result;
use App\Candidate;
use App\Party;

class WardsResource extends Resource
{
    public function toArray($request)
    {
        $candidates = Candidate::all();
        $constituency = Constituency::find($this->constituency_id);
        if (!$constituency) {
            $returns= parent::toArray($request);
        } else {
            $district = District::find($constituency->id);
            if (!$district) {
                $returns= parent::toArray($request);
            } else {
               $centres=Centre::where('ward_id',$this->id)->get();
               if (!$centres) {
                    $returns= parent::toArray($request);
               } else {
                    //looping through results
                    $results = Result::where('ward_id',$this->id)->get();
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
                            ['candidate_id','=',$candidate->id],['ward_id','=',$this->id]
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
                        'district_id'=>  $district->id , 
                        'district_name'=>$district->name, 
                        'constituency_id'=>$constituency->id , 
                        'constituency_name'=> $constituency->name, 
                        'centres'=>count($centres),
                        'results'=>$totalResults,
                        'candidates'=>$newCandidates
                    ];
               } 
            } 
        }
        
        return $returns;
    }
}
