<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\District;
use App\Constituency;
use App\Ward;
use App\Centre;
use App\Region;
use App\Result;

class QueryRunnerController extends Controller
{
    

    public function updateResults()
    {
        $results = Result::where('region_id', 0)->get();
        foreach($results as $result){
            $result->region_id = District::where('id', $result->district_id)->value('region_id');
            return $result;
        }
    }
}
