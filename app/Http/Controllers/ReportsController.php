<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ObserverResponse;

class ReportsController extends Controller
{
    


    public function responses()
    {
        $data = ["reported"=>0, "resolved"=>0, "unresolved"=>0];
        $responses = ObserverResponse::where('status', '!=', null)->get();
        foreach($responses as $response){
            switch ($response->status) {
                case 'flagged':
                    $data['reported'] = $data['reported']+1;
                    break;
                case 'resolved':
                    $data['resolved'] = $data['resolved']+1;
                    break;
                case 'resolving':
                    $data['unresolved'] = $data['unresolved']+1;
                    break;
                
                default:
                    break;
            }
        }
        return view('reports.response', compact('data'));
    }
}
