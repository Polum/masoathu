<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sms;
use UTMRef;

class SMSApiController extends Controller
{
    public function index()
    {
        $sms = array();
        $tempsms1 = (object)[];
        $tempsms2 = (object)[];
        $tempsms3 = (object)[];
        $a_var =  "nothing";
        foreach (Sms::select('id', 'text', 'number', 'created_at')->orderBy('id', 'asc')->where('created_at', '>', '2018-09-03 08:00:00')->limit(5000)->cursor() as $singleSms) {
            $found=false;
            //echo $singleSms;


            try{
                /*foreach($smsChecksum as $singleSmsCheckSum) {
                    if ($singleSmsCheckSum->text === $singleSms->text) {
                        $found = true;
                        break;
                        //echo $singleSmsCheckSum->text;

                    }
                }*/
                if($tempsms1->text === $singleSms->text || $tempsms2->text === $singleSms->text|| $tempsms3->text === $singleSms->text){
                    $found = true;
                }
            }catch (\Exception $e){

            }
            $tempsms3 = $tempsms2;
            $tempsms2 = $tempsms1;
            $tempsms1 = $singleSms;
            /*$smsChecksum[2] = $smsChecksum[1];
            $smsChecksum[1] = $smsChecksum[0];
            $smsChecksum[0] = $singleSms;*/
            //$smsChecksum[0] = $singleSms->text;
            if(!$found){
                array_push($sms, $singleSms);
            }
        }
        return $sms;
        //$sms = Sms::select('id', 'text','number', 'created_at')->orderBy('id', 'desc')->where('created_at', '>', '2018-09-18 08:00:00')->limit(10000)->get();
        //return $a_var->toString();
        /*Sms::select('id', 'text','number', 'created_at')->orderBy('id', 'desc')->where('created_at', '>', '2018-08-16 00:00:00')->get();*/
    }

    public function show($id)
    {
        return Sms::find($id);
    }

    public function store(Request $request)
    {
        return Sms::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $Sms = Sms::findOrFail($id);
        $Sms->update($request->all());

        return $Sms;
    }

    public function delete(Request $request, $id)
    {
        $Sms = Sms::findOrFail($id);
        $Sms->delete();

        return 204;
    }
}
