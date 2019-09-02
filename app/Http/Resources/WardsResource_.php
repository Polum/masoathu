<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use DB;
use App\District;
use App\constituency;
use App\Centre;
use App\Result;
use App\ResultsDetails;
use App\Candidate;
use App\Party;

class WardsResource_ extends JsonResource
{
    public function toArray($request)
    {
        $candidates = Candidate::all();
        $constituency = District::find($this->constituency_id);  
        $centres=Centre::where('ward_id',$this->id)->get();
        //
        $totalResults = 0;  
        $allResults = [];
        $detailResults = ResultsDetails::where('ward_id',$this->id)->get();
        if($detailResults){ 
            foreach ($detailResults as $key => $detail) {
                $resultsCentre = Result::where('details_id',$detail->id)->get(); 
                if (count($resultsCentre)!==0) {
                    foreach ($resultsCentre as $item) { 
                        $votes = $item->votes;
                        $totalResults = $totalResults+$votes;
                        array_push($allResults,$item);  
                    }
                } 
            }
        }
        // 
        $newCandidates=[];
        if ($candidates) {
            foreach ($candidates as $key => $candidate) {
                $totalResultsCandidate = 0;
                foreach ($allResults as $key => $result) {
                    if ($result->candidate_id==$candidate->id) {
                        $totalResultsCandidate = $totalResultsCandidate+$result->votes;
                    }
                }
                array_push($newCandidates,[
                    'id'=> $candidate->id,
                    'name'=> $candidate->name, 
                    'party_id'=>$candidate->party_id, 
                    'results'=>$totalResultsCandidate
                ]);
            }
        }
        //
        return [
            'id'=> $this->id,
            'name'=> $this->name,  
            'code'=>  $this->code,  
            'constituency_id'=> $constituency?$constituency->id:null, 
            'constituency_name'=>  $constituency?$constituency->name:null, 
            'centres'=>count($centres),
            'results'=>$totalResults,
            'candidates'=>$newCandidates 
        ];
    }
}
