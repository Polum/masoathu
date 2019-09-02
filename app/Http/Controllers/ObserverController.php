<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-11
 * Time: 6:40 AM
 */


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Observer;
use App\ElectionObserver;
use App\ObserverApi;
use App\ObserverResponse;
use App\Sms;
use App\Http\Resources\ObserversResource;

class ObserverController extends Controller
{
    public function index()
    {
        return Observer::orderBy('id', 'asc')->get();
    }
    
    public function apiIndex()
    {
        $observers = ElectionObserver::orderBy('first_name','asc')->paginate(10); 
        return ObserversResource::collection($observers);
    } 
    public function apiIndexAll()
    { 
        $observers = ElectionObserver::all();
        return ObserversResource::collection($observers);
    }
    public function apiShow($id)
    {
        $observer = ObserverApi::findOrFail($id);
        return new ObserversResource($observer);
    }

    public function show($id)
    {
        return Observer::find($id);
    }

    public function store(Request $request)
    {
        return Observer::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $Observer = Observer::findOrFail($id);
        $Observer->update($request->all());

        return $Observer;
    }

    public function delete(Request $request, $id)
    {
        $Observer = Observer::findOrFail($id);
        $Observer->delete();

        return 204;
    }

    public function retro()
    {
        $texts = DB::table('sms')->where('text', '!=', '')
        ->where('sms.text', '!=', null)
        ->select('sms.number')
        ->get();
        $query = DB::table('observers')
                            ->join('sms', 'observers.phone_number', '=', 'sms.number')
                            ->select('observers.first_name', 'observers.phone_number')
                            ->get();
        
        return $texts;
    }
    
    public function dosile()
    {
        return view("clerk.observerCheck");
    }
    
    public function unresponsive()
    {
        // $responsive = [];
        
        // $numbers = ObserverResponse::distinct()->get(['number']);
        // foreach($numbers as $number){
        //     ($number->number != null)? array_push($responsive, $number->number): null;
        // }
        
        // $dosile = ElectionObserver::whereNotIn('phone_number', $responsive)->get();
        
        $dosile = ElectionObserver::whereNotIn('id', function($query){
            $query->select('phone_number')
                ->from('observer_responses');
        })->get();
        
        return $dosile;
    }
}