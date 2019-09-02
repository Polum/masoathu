<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ObserverChecklist;

class ObserverChecklistController extends Controller
{
    


    public function questions()
    {
        $questions = DB::table('observer_checklist')->select("id", "question_no", "body")->get();
        return response()->json(['status'=>"success", 'data'=>$questions, 'message'=>'success'], 200);
    }
}
