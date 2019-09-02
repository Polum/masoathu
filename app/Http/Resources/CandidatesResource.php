<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use DB;
use App\Party;
use App\RunningMate;
use App\CandidateType; 
use App\Result;

class CandidatesResource extends Resource
{
     
    public function toArray($request)
    {
        // $party = DB::select('SELECT * FROM parties WHERE id ='.$this->id);
        $party = Party::find($this->party_id);
        $runningmate = RunningMate::where('candidate_id',$this->id)->get();
        $CType = CandidateType::find($this->type);
        $results = Result::where('candidate_id',$this->id)->get();
        $totalResults =0;
        if (count($results)!==0) {
            foreach ($results as $item) {
                $value = $item->value;
                $totalResults = $totalResults+$value;
            }
        }
        return [
            'id'=> $this->id,
            'name'=> $this->name, 
            // 'age'=> $this->age, 
            'gender'=> $this->gender, 
            'type'=> $CType->name, 
            'party_id'=>$party->id,
            'party_name'=>$party->name,
            'runningmate_id'=>$runningmate[0]->id,
            'runningmate_name'=>$runningmate[0]->name,
            'results'=>$totalResults
        ];
    }
}
