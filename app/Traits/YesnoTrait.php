<?php

namespace App\Traits;

use App\ObserverResponse;
use Illuminate\Support\Facades\DB;

trait YesnoTrait {

    public function template($id, $label = ["yes", "no"])
    {
        $data = [];
        $data[$label[0]] = 0;
        $data[$label[1]] = 0;
        $observerResponse = ObserverResponse::where('question_id',$id)->get();
        
        foreach($observerResponse as $response){
            $str = $response->text;
            $question_no = $this->questionNo($str);
            $value = implode('',explode($question_no, $str));

            $data[$label[0]] = ($value == 1)? $data[$label[0]]+1 : $data[$label[0]];
            $data[$label[1]] = ($value == 2 || $value == 0)? $data[$label[1]]+1 : $data[$label[1]];
        }
        return $data;
    }

    public function maleFemale($qid1, $qid2)
    {
        $data = [];
        $data['male'] = 0;
        $data['female'] = 0;
        $observerResponse = ObserverResponse::where('question_id',$qid1)->orWhere('question_id', $qid2)->get();
        foreach($observerResponse as $response){
            $queue = substr($response->text, 2);
            $data['male'] = (substr($response->text, strpos($response->text, 'b'),1) == 'b')? ((int)$data['male'])+$queue : $data['male'];
            
            $data['female'] = (substr($response->text, strpos($response->text, 'a'),1) == 'a')? ((int)$data['female'])+$queue : $data['female'];
        }
        return $data;
    }

    public function valueLooper($idArray)
    {
        $data = array_fill(0,sizeOf($idArray), 0);
        $retrived = [];

        $observerResponse = ObserverResponse::whereIn('question_id',$idArray)->get();
        
        if($observerResponse){
            foreach($observerResponse as $response){
                $str = $response->text;
                $question_no = $this->questionNo($str);
                $value = implode('',explode($question_no, $str));
                if(array_key_exists($response->question_id, $retrived)){
                    $retrived[$response->question_id] = $retrived[$response->question_id] + (int)$value;
                }
                else{
                    $retrived[$response->question_id] = (int)$value;
                }
            }

            foreach($retrived as $key => $value){
                $keyData = array_search($key, $idArray);
                $data[$keyData] = $value;
            }
        }

        return $data;
    }

    public function reports($type)
    {
        $data = 0;
        switch ($type) {
            case 'incoming_messages':
                $result = ObserverResponse::all()->count();
                $data = $result;
                break;
            
            case 'reports_generated':
                $result = ObserverResponse::where('status', '!=', null)->count();
                $data = $result;
                break;

            case 'incidence_alert':
                $result = DB::table('observer_responses')
                ->join('observer_checklist', 'question_id', 'observer_checklist.id')
                ->where('status', '!=', null)
                ->where('observer_checklist.category', 'incidences')->count();
                $data = $result;
                break;
            
            default:
                # code...
                break;
        }

        return $data;
    }
    
    public function countReport($id)
    {
        $results = DB::table('observer_responses')->where('question_id', $id)->count();
        return $results;
    }

    private function questionNo($data)
    {
        $strArray = explode(';', $data);
        $chars = (sizeOf($strArray) > 1)? $strArray[0]: $data;
        $charArray = str_split($chars);
        $char = '';

        foreach($charArray as $letter){
            if(in_array($letter, $this->alpha)){
                $char .= $letter;
            }
        }
        $charSize = strlen($char);
        $question_no = substr($data, 0, strpos($data, $char)+$charSize);
        return $question_no;
    }
}