<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use DB;
use App\Party;
use App\Candidate;
use App\CandidateType;

class RunningMatesResource extends Resource
{
    public function toArray($request)
    {
        $candidates = Candidate::find($this->id);
        $party = Party::find($candidates->party_id);
        $CType = CandidateType::find($candidates->type);

        return [
            'id'=> $this->id,
            'name'=> $this->name, 
            // 'age'=> $this->age, 
            'gender'=> $this->gender,  
            'party_id'=>$party->id,
            'party_name'=>$party->name,
            'candidate_id'=>$candidates->id,
            'candidate_name'=>$candidates->name,
        ];
    }
}
