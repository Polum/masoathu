<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use DB;
use App\RunningMate;
use App\Candidate;
use App\CandidateType;

class PartiesResource extends Resource
{ 
    public function toArray($request)
    {
        $candidates=Candidate::where('party_id',$this->id)->get();
        $runningmate = RunningMate::where('candidate_id',$candidates[0]->id)->get();
        return [
            'id'=> $this->id,
            'name'=> $this->name,  
            'short_name'=> $this->short_name,  
            'candidate_id'=>$candidates[0]->id,
            'candidate_name'=>$candidates[0]->name,
            'runningmate_id'=>$runningmate[0]->id,
            'runningmate_name'=>$runningmate[0]->name,
        ];
    }
}
