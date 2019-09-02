<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CandidatesResource;
use App\Candidate;

class CandidateController extends Controller
{
    public function indexAll()
    { 
        $candidates = Candidate::all();
        return CandidatesResource::collection($candidates);
    }   

    public function show()
    {
        $candidates = Candidate::all();
        return $candidates;
    }

    public function candidate($id)
    {
        return redirect('candidate')->with(['id' => $id]);
    }

    public function showOne($id)
    {
        $candidate = Candidate::findOrFail($id);
        return new CandidatesResource($candidate);
    }
}
