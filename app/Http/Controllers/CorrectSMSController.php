<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/4/18
 * Time: 4:50 PM
 */

namespace App\Http\Controllers;


use App\Polling_Station;
use App\Question;
use App\Sms;
use App\Observer;
use UTMRef;
use App\Correct_SMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CorrectSMSController extends Controller
{
    public function index()
    {

        return Correct_SMS::with('registrationCenter')->with('originalSms')->get();
        $pollingStations = array();
        foreach (Correct_SMS::orderBy('id', 'asc')->cursor() as $singlePollingStation) {

            $regCenterCordinates = Polling_Station::findOrFail($singlePollingStation->center_id);
            /*$originalSms = Sms::findOrFail($singlePollingStation->sms_id);
            //$number = "0".$originalSms->number;

            $observer = Observer::where('phone_number', '=', "0"+$originalSms->number)->first();
            //return $regCenterCordinates;
            //convert the location from UTM to DD*/
            $singlePollingStation->y_coordinate = $regCenterCordinates->y_coordinate;
            $singlePollingStation->x_coordinate = $regCenterCordinates->x_coordinate;
          /*  try{
                $singlePollingStation->number = $observer->first_name. " ". $observer->last_name;
            }catch (\Exception $e){
                //echo $e." -- ". $originalSms->number;
                $singlePollingStation->number = +$originalSms->number;
            }*/
            $singlePollingStation->name = $regCenterCordinates->name;

            //return $singlePollingStation;
            array_push($pollingStations, $singlePollingStation);

        }
        return $pollingStations;
    }

    public function messageWithOriginal($id){
        return Correct_SMS::where('id', '=', $id)->with('originalSms')->with('registrationCenter')->first();
    }

    public function show($id)
    {
        return Correct_SMS::find($id);
    }

    public function store(Request $request)
    {
        return Correct_SMS::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $correctSMS = Correct_SMS::findOrFail($id);
        $correctSMS->update($request->all());

        return $correctSMS;
    }

    public function delete(Request $request, $id)
    {
        $correctSMS = Correct_SMS::findOrFail($id);
        $correctSMS->delete();

        return 204;
    }

    public function filterSms()
    {
        $regCentersData = Polling_Station::select('id', 'name', 'code', 'parent_id', 'x_coordinate', 'y_coordinate', 'parent_id')->with('administrativeDivisions.administrativeDivisionsParent.administrativeDivisionsParent.administrativeDivisionsParent')->with('administrativeDivisions')->get();

        $time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];

        $regCentersData1 = json_encode($regCentersData, true);
        $regCentersData1 = json_decode($regCentersData1);
        $smsToSave = new Correct_SMS();
        //echo "Process Time: {$time}";

        $questionSetData = Question::where('created_at', '>', '2018-08-12 00:00:00')->orderBy('created_at', 'asc')->get();
        $sms = array();
        $tempsms1 = (object)[];
        $tempsms2 = (object)[];
        $tempsms3 = (object)[];
        $a_var = "nothing";
        return DB::table('sms_temp')->get();
        //return Sms::select('id', 'text', 'number', 'created_at')->orderBy('id', 'desc')->where([['created_at', '>', '2018-09-15 08:00:00'],['created_at', '<', '2018-10-23 21:00:00'],['id', '<',88017]])->limit(10)->get();

        foreach (DB::table('sms_temp')->orderBy('id', 'desc')->where([['created_at', '>', '2018-09-15 08:00:00'], ['created_at', '<', '2018-10-23 21:00:00']])->cursor() as $singleSms) {
            $found = false;
            //echo $singleSms;
            //echo "id: ".$singleSms->id.", region_id: ".$regCentersData[1]."<br />";

            //foreach ($regCentersData1 as $key => $value) {
            /*if ($value['administrative_divisions']) {
                return $key;
            }*/
            // echo $value['id']."<br />";
            //}
            /*foreach ($regCentersData as $regd){
                echo $regd->id."<br />";

            }*/
            try {
                /*foreach($smsChecksum as $singleSmsCheckSum) {
                    if ($singleSmsCheckSum->text === $singleSms->text) {
                        $found = true;
                        break;
                        //echo $singleSmsCheckSum->text;

                    }
                }*/
                if ($tempsms1->text === $singleSms->text || $tempsms2->text === $singleSms->text || $tempsms3->text === $singleSms->text) {
                    $found = true;
                }
            } catch (\Exception $e) {

            }
            $tempsms3 = $tempsms2;
            $tempsms2 = $tempsms1;
            $tempsms1 = $singleSms;
            /*$smsChecksum[2] = $smsChecksum[1];
            $smsChecksum[1] = $smsChecksum[0];
            $smsChecksum[0] = $singleSms;*/
            //$smsChecksum[0] = $singleSms->text;
            if (!$found) {
                //now check the sms for validity
                $number = $singleSms->number . "";
                if (substr($number, 0, 3) === "265") {

                    $smsTextSplit = explode(";", $singleSms->text);
                    for ($m = 0; $m < sizeof($smsTextSplit); $m++) {
                        //if()
                        //$output = "<span class=\"label label-danger\">Incorrect - Format</span>";
                        try {
                            //check if message is correct or not correct
                            if (substr($smsTextSplit[0], 0, 3) === "ICD") {
                                //output = "<span class=\"label label-success\">Correct - Incident</span>";
                                //return output;
                            } else {
                                for ($j = 0; $j < sizeof($regCentersData); $j++) {
                                    $regCenterCode = $regCentersData[$j]->code . "";

                                    //console.log(regCentersData[j].code+" -- "+regCenterCode);
                                    if (substr($smsTextSplit[0], 0) === $regCenterCode) {
                                        if (substr($smsTextSplit[$m], 0, 1) === "A" || substr($smsTextSplit[$m], 0, 1) === "B" || substr($smsTextSplit[$m], 0, 1) === "C" || substr($smsTextSplit[$m], 0, 1) === "D") {
                                            if (!is_numeric(substr($smsTextSplit[$m], 1, 2))) {
                                                if ((!is_numeric(substr($smsTextSplit[$m], 2, 3))) || (substr($smsTextSplit[$m], 2, 3) === "E")) {
                                                    /*output = "<span class=\"label label-success\">Correct</span>\n";*/

                                                }
                                            } else {
                                                /*output = "<span class=\"label label-danger\">Incorrect - Q Category</span>";*/
                                            }
                                            break;
                                        } else {
                                            /*output = "<span class=\"label label-danger\">Incorrect - Reg Center</span>";*/
                                        }
                                    }
                                }
                            }
                        } catch
                        (\Exception $e) {
                            echo("An error=>" . $e . ", happened on sms: " . $singleSms->text);
                            //output = "<span class=\"label label-danger\">Incorrect - Whole Format</span>";
                            //return output;output = "<span class=\"label label-success\">Correct</span>\n";
                        }
                    }
                    //return output;
                } else {
                    $smsTextSplit = explode(";", $singleSms->text);
                    try {

                        for ($j = 0; $j < sizeof($regCentersData); $j++) {
                            $regCenterCode = $regCentersData[$j]->code . "";

                            //console.log(regCentersData[j].code+" -- "+regCenterCode);
                            if (substr($smsTextSplit[0], 0) === $regCenterCode) {
                                echo "code found -- $smsTextSplit[1]<br />";
                                if (substr($smsTextSplit[1], 0, 1) === "A" || substr($smsTextSplit[1], 0, 1) === "B" || substr($smsTextSplit[1], 0, 1) === "C" || substr($smsTextSplit[1], 0, 1) === "D") {
                                    echo "Question Cat Found " . $singleSms->text . " -- " . substr($smsTextSplit[1], 1, 2) . "<br />";
                                    //echo $smsTextSplit[1] . "<br />";


                                    if (is_numeric(substr($smsTextSplit[1], 1, 1))) {

                                        if ((is_numeric(substr($smsTextSplit[1], 1, 1))) || (substr($smsTextSplit[1], 2, 1) === "E") || (substr(2, 1) === "q") || (substr($smsTextSplit[1], 3, 1) === "q")) {
                                            echo "String<br /> ";
                                            //determine what question number it is
                                            $questionSplit = explode("q", $smsTextSplit[1]);

                                            //if (smsTextSplit[1].substring(2, 3) === "q" || smsTextSplit[1].substring(3, 4) === "q" ) {
                                            if (sizeof($questionSplit) > 1) {
                                                for ($i = 0; $i < sizeof($questionSetData); $i++) {
                                                    $idString = $questionSetData[$i]->id;
                                                    $idString = (String)$idString;
                                                    // echo "String conversion and comparison" . $idString . " -- " . $questionSplit[1];
                                                    //if (smsTextSplit[1].substring(3) === idString) {
                                                    if ($questionSplit[1] === $idString) {
                                                        /*output = "<span class=\"label label-success\">Correct</span>\n";*/
                                                        sleep(1);

                                                        $smsToSave = new Correct_SMS();


                                                        $smsToSave->sms_id = $singleSms->id;
                                                        $smsToSave->region_id = $regCentersData1[$j]->administrative_divisions->administrative_divisions_parent->administrative_divisions_parent->administrative_divisions_parent->id;
                                                        $smsToSave->district_id = $regCentersData1[$j]->administrative_divisions->administrative_divisions_parent->administrative_divisions_parent->id;
                                                        $smsToSave->constituency_id = $regCentersData1[$j]->administrative_divisions->administrative_divisions_parent->id;
                                                        $smsToSave->ward_id = $regCentersData1[$j]->administrative_divisions->id;
                                                        $smsToSave->center_id = $regCentersData1[$j]->administrative_divisions->id;
                                                        $smsToSave->question_id = $questionSetData[$i]->id;
                                                        $textSms = explode(";", $singleSms->text);
                                                        $smsToSave->content = $textSms[2];
                                                        //check if message is correct or not correct
                                                        if (substr($smsTextSplit[0], 0, 3) === "ICD") {
                                                            $smsToSave->type = 2;
                                                            echo "ICD <br />";
                                                        } else {
                                                            $smsToSave->type = 1;
                                                        }
                                                        echo $smsToSave->id . "<br />";
                                                        $smsToSave->save();
                                                    }
                                                }
                                            }
                                            //return "<span class=\"label label-danger\">Incorrect</span>\n";
                                            //return "<span class=\"label label-success\">Correct</span>\n";
                                        } else if (substr($smsTextSplit[1], 1, 2) === "2" && substr($smsTextSplit[1], 0, 1) === "B") {
                                            /*output = "<span class=\"label label-success\">Correct</span>\n";*/
                                        }
                                    }

                                } else {
                                    /*output = "<span class=\"label label-danger\">Incorrect - Q Category</span>";*/
                                }
                                break;
                            } else {
                                /*output = "<span class=\"label label-danger\">Incorrect - Reg Center</span>";*/
                            }
                        }

                    } catch (\Exception $e) {
                        /*console . log("An error=>" + e . toString() + " happened on sms: " + text);*/
                        /*output = "<span class=\"label label-danger\">Incorrect - Whole Format</span>";*/
                        //return output;
                    }
                    //return output;
                }
                //array_push($sms, $singleSms);
            }
        }
        //$sms;
    }

    public function addMessages()
    {


        $correctSMS = Correct_SMS::all();
        return $correctSMS;
        foreach ($correctSMS as $singleSMS) {
            $unfilterefSMS = Sms::findOrFail($singleSMS->sms_id);
            $sms = explode(";", $unfilterefSMS->text);

            $toUpdateSMS = Correct_SMS::findOrFail($singleSMS->id);
            $toUpdateSMS->content = $sms[2];
            $toUpdateSMS->save();
            //echo $toUpdateSMS;
        }

    }

    public function addIncidents()
    {
        $regCentersData = Polling_Station::select('id', 'name', 'code', 'parent_id', 'x_coordinate', 'y_coordinate', 'parent_id')->with('administrativeDivisions.administrativeDivisionsParent.administrativeDivisionsParent.administrativeDivisionsParent')->with('administrativeDivisions')->get();
        return "Hi";

        $regCentersData1 = json_encode($regCentersData, true);
        $regCentersData1 = json_decode($regCentersData1);
        $smsToSave = new Correct_SMS();
        foreach (DB::table('sms_temp')->orderBy('id', 'desc')->where([['created_at', '>', '2018-09-15 08:00:00'], ['created_at', '<', '2018-10-23 21:00:00']])->cursor() as $singleSms) {
            $smsTextSplit = explode(";", $singleSms->text);

            for ($j = 0; $j < sizeof($regCentersData); $j++) {
                //$regCenterCode = $regCentersData[$j]->code . "";
                //echo $regCenterCode." -- ";
                $smsCenterCode = (Integer)$smsTextSplit[1];
                //echo $regCentersData[$j]->code." -- ";
                if ($smsCenterCode == $regCentersData[$j]->code) {

                    $smsToSave = new Correct_SMS();
                    $smsToSave->sms_id = $singleSms->id;
                    $smsToSave->region_id = $regCentersData1[$j]->administrative_divisions->administrative_divisions_parent->administrative_divisions_parent->administrative_divisions_parent->id;
                    $smsToSave->district_id = $regCentersData1[$j]->administrative_divisions->administrative_divisions_parent->administrative_divisions_parent->id;
                    $smsToSave->constituency_id = $regCentersData1[$j]->administrative_divisions->administrative_divisions_parent->id;
                    $smsToSave->ward_id = $regCentersData1[$j]->administrative_divisions->id;
                    $smsToSave->center_id = $regCentersData1[$j]->administrative_divisions->id;
                    $smsToSave->question_id = substr($smsTextSplit[0], 3);
                    $smsToSave->content = $smsTextSplit[2];
                    //check if message is correct or not correct
                    $smsToSave->type = 2;
                    echo $smsToSave->content . "<br />";
                    $smsToSave->save();
                    break;
                }
            }
        }
    }

    public function getMessagesByRegion($id)
    {
        return Correct_SMS::where('region_id', '=', $id)->get();
    }

    public function getMessagesByDistrict($id)
    {
        return Correct_SMS::where('district_id', '=', $id)->get();
    }

    public function getMessagesByConstituency($id)
    {
        return Correct_SMS::where('constituency_id', '=', $id)->get();
    }

    public function getMessagesByWard($id)
    {
        return Correct_SMS::where('ward_id', '=', $id)->get();
    }

    public function getMessagesByCenter($id)
    {
        return Correct_SMS::where('center_id', '=', $id)->get();
    }

    public function getMessagesByQuestion($questionId)
    {
        return Correct_SMS::where('question_id', '=', $questionId)->get();
    }

    public function getMessagesIncidents()
    {
        return Correct_SMS::where('type', '=', 2)->get();
    }
}