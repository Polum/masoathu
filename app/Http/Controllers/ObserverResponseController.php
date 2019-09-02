<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\District;
use App\RegionCluster;
use App\ObserverResponse;
use App\ObserverChecklist;
use App\Traits\YesnoTrait;
use App\Traits\MorningTrait;
use App\Traits\AfternoonTrait;
use App\Traits\EveningTrait;
use App\Traits\MorningIncidentTrait;

class ObserverResponseController extends Controller
{
    use YesnoTrait, MorningTrait, AfternoonTrait, EveningTrait, MorningIncidentTrait;

    public function __construct()
    {
        // $this->middleware('auth');
        $this->alpha = array_merge(range('a', 'z'), range('A', 'Z'));
    }
    
    public function index()
    {
        $data = $this->morning();
        // return $data;
        return view('admin.pages.morning',compact('data'));
    }

    public function morning(){
        return $this->morningTemplate();
    }
    

    public function afternoon()
    {
        $data = $this->afternoonTemplate();
        return view('admin.pages.afternoon',compact('data'));
    }

    public function evening()
    {
        $data =  $this->eveningTemplate();
        return view('admin.pages.evening',compact('data'));
    }
    
    public function incidents($timeline)
    {
        $data = [];
        
        switch  ($timeline) {
            case 'morning':
              $data = $this->morningIncidents();
              break;
            
            default:
                break;
        }
        
        return $data;
    }
    
    public function checklistpage($question_no)
    {
        return redirect('checklist')->with(['question_no'=>$question_no]);
    }
    
    public function checklist($question_no)
    {
        $checklistResponse = ObserverResponse::with(['question', 'district', 'constituency', 'ward', 'centre'])->where('question_id', $question_no)->get();
        return $checklistResponse;
    }

    public function store(Request $request)
    {
        $observerResponse = $request->all();
        $question_no = $this->questionNo($request->text);
        
            
        $question = ObserverChecklist::where('question_no',$question_no)->first();
        $district = District::where('id', $observerResponse["district_id"])->first();
        $observerResponse["region_id"] = $district->region_id;
        if($question){
            $observerResponse["question_id"] = $question->id;
            $result = ObserverResponse::create($observerResponse);
            if($result){
                return response()->json(['status'=>"success", 'data'=>[$result], 'message'=>'success'], 200);
            }
            return response()->json(['status'=>"error", 'data'=>[$observerResponse], 'error'=>'error'], 404);
        }
        return response()->json(['status'=>"error", 'data'=>[$observerResponse], 'error', 'error 404'], 404);
    }

    public function sms(Request $request)
    {
        $response = New ObserverResponse();

        $texts = explode(',', $request->message);
        foreach($texts as $text){
            $response["number"] = $request->from;
            $response["text"] = $text[1];
            $response["question_id"] = $this->questionNo($text[1]);
            $response["centre_id"] = Centre::where('code', $text[0])->value('id');
            $response["ward_id"] = Ward::where('code', $response["centre_id"])->value('id');
            $response["constituency_id"] = Centre::where('code', $response["ward_id"])->value('id');
            $response["district_id"] = Centre::where('code', $response["constituency_id"])->value('id');
            $response["region_id"] = Centre::where('code', $response["district_id"])->value('id');

            if($response->save){
                $response = json_encode([
                    "payload"=> [
                        "success"=>"Success",
                            "error" => "errro"
                        ]
                    ]);
                return $response;
            }
        }
        
    }

    public function update(Request $request)
    {
        $message = $request->all();
        $question_no = $this->questionNo($request->text);

        $response = ObserverResponse::find($request->id);
        
        if($response){
            foreach($message as $key => $value){
                $response->$key = $message[$key]? $value: $response->$key;
            }
            $question = ObserverChecklist::where('question_no',$question_no)->first();
            $response->question_id = $question->id;
            if($response->save()){
                return Response(['code' => 202, 'data'=>[$response], 'message' => 'Message updated succesfully'], 202);
            }
            return Response(['code' => 401, 'message' => 'Failed to update message'], 401);
        }
        return Response(['code' => 401, 'message' => 'Doesnt exist'], 401);
    }

    public function ontime()
    {
        $data = [];
        $data['ontime'] = 0;
        $data['late'] = 0;
        $observerResponse = ObserverResponse::where('question_id',1)->get();
        foreach($observerResponse as $response){
            $time = substr($response->text, 2);
            $time = (strlen((string)$time) == 2)? $time."0": $time;
            $time = (int)$time;
            $data['ontime'] = ($time <= 730)? $data['ontime']+1 : $data['ontime'];
            $data['late'] = ($time > 730)? $data['late']+1 : $data['late'];
        }
        return $data;
    }

    public function responses()
    {
        $cluster = RegionCluster::where('user_id', Auth::user()->id)->first();
        if(!empty($cluster)){
            $ids = $cluster->cluster;
            $responses = ObserverResponse::where('region_id', [$cluster])->where('status', '=', null)
                    ->where('seen', false)->get();
            return $responses;
        }
        return [];
    }

    public function flag(Request $request)
    {
        $request = $request->all();
        $id = $request['flagged']['id'];
        $observerResponse = ObserverResponse::find($id);
        $observerResponse['status'] = 'flagged';
        $observerResponse->save();
        return $observerResponse;
    }

    public function seen(Request $request)
    {
        $request = $request->all();
        $id = $request['seen']['id'];
        $observerResponse = ObserverResponse::find($id);
        $observerResponse['seen'] = true;
        $observerResponse->save();
        return $observerResponse;
    }

    public function flagged()
    {
        $responses = ObserverResponse::where('region_id', Auth::user()->region_id)->where('status', 'flagged')->get();
        return $responses;
    }

    public function resolve(Request $request)
    {
        $request = $request->all();
        $id = $request['resolving']['id'];
        $observerResponse = ObserverResponse::find($id);
        $observerResponse['status'] = 'resolving';
        $observerResponse->save();
        return $observerResponse;
    }

    public function resolving()
    {
        $responses = ObserverResponse::where('region_id', Auth::user()->region_id)->where('status', 'resolving')->get();
        return $responses;
    }

    public function resolved(Request $request)
    {
        $request = $request->all();
        $id = $request['resolved']['id'];
        $observerResponse = ObserverResponse::find($id);
        $observerResponse['status'] = 'resolved';
        $observerResponse->save();
        return $observerResponse;
    }

    public function completed()
    {
        $responses = ObserverResponse::where('region_id', Auth::user()->region_id)->where('status', 'resolved')->get();
        return $responses;
    }

}
