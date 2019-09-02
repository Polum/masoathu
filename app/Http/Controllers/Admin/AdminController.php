<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\Admin;

use App\Correct_SMS;
use App\Http\Controllers\FlaggedIncidentController;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sms;
use App\Incident;
use App\Fagged_Incident;
use Illuminate\Http\Request;
use App\Admin_Division_Level;
use App\Admin_Division;
use App\Polling_Station;
use App\Question;



class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function getIndex()
    {
        $totalSMSCount = Sms::count();
        $totalCorrectSMS = Correct_SMS::count();
        $registeredVoters = Correct_SMS::where('question_id','=', 68)->get();
        $incidentData = Incident::all();
        $questionData = Question::where('created_at', '>', '2018-08-12 00:00:00')->get();
        $flaggedIncidents = Fagged_Incident::count();
        //return $registeredVoters;
        return view('admin.pages.index', compact('totalCorrectSMS', 'totalSMSCount',  'registeredVoters', 'incidentData', 'questionData'));
    }

    public  function getLogin()
    {
        return view('admin.pages.login');
    }

    public  function getMapOverview()
    {
        $smsData = Correct_SMS::select('id', 'type',  'center_id')->with('registrationCenter')->get();
        $questionData = Question::all();
        $incidentCategories =  Incident::orderBy('id', 'asc')->get();
        $incidentColoursBackground = ['#C1232B4d', '#bfc31c4d', '#27727B4d', '#60C0DD4d', '#fcb5004d', '#e800a64d', '#5d85fe4d', '#0eca214d', '#b0a3fa4d', '#F3A43B4d', '#D7504B4d', '#C6E5794d', '#F4E0014d', '#F0805A4d', '#26C0C04d'];
        return view('admin.pages.map',  compact('smsData',  'incidentCategories', 'incidentColoursBackground', 'questionData'));
    }


    public  function getOpenMessages()
    {
        return view('admin.pages.messages.open_messages');
    }


    public  function getObservers()
    {
        return view('admin.pages.observers.list');
    }

    public  function getUsers()
    {
        return view('admin.pages.users.user_list');
    }

    public  function getQuestions()
    {
        return view('admin.pages.questions.list');
    }

    
    public  function getObserverChecklist()
    {
    	return view('admin.pages.messages.observer_checklist');
    }

    public  function getOpenReports()
    {
    	return view('admin.pages.reports.open_reports');
    }

    public  function getChecklistReports()
    {
    	return view('admin.pages.reports.checklist_reports');
    }

    public  function getCandidateReports()
    {
        return view('admin.pages.candidates.candidate_reports');
    }

    public  function getIncidentReports()
    {
        $incidentCategories =  Incident::orderBy('id', 'asc')->get();
        $incidentColoursBackground = ['#C1232B4d', '#bfc31c4d', '#27727B4d', '#60C0DD4d', '#fcb5004d', '#e800a64d', '#5d85fe4d', '#0eca214d', '#b0a3fa4d', '#F3A43B4d', '#D7504B4d', '#C6E5794d', '#F4E0014d', '#F0805A4d', '#26C0C04d'];

        return view('admin.pages.reports.incident_reports', compact('incidentCategories', 'incidentColoursBackground'));
    }

    public  function getObserverChecklistReport()
    {
        return view('admin.pages.reports.observer_check_list_report');
    }

    public  function getAdministrativeDivision()
    {
        $adminDivLevels = Admin_Division_Level::all();
        //dd($adminDivLevels);
    	return view('admin.pages.administrative_divisions', compact('adminDivLevels'));
    }
    public function getAdministrativeLevels($id){
        $id = (int) $id;
        $adminLevels = Admin_Division_Level::all();
        if($adminLevels->count() >= $id){
            $AdminDiv = Admin_Division::where('level_id','=',$id)->get();
            $adimDivLevel =  Admin_Division_Level::findOrFail($id);
            $adminLevelName = $adimDivLevel->name;

        }else{
            $AdminDiv = Polling_Station::all();
            $adminLevelName = "Registration Center";
        }

        /*foreach ($selectedSDG as $sdg) {
            $sdgId = $sdg->id;
        }*/

        //$dataSubSdgs = SubSdg::where('sdg_id', '=', $selectedSDG->id)->get();

        //$dataSubSdgs = SubSdg::with('indicator.levelOfDi.historicalData.yearValue')->get();

        $data = array();

        array_push($data, $id);
        array_push($data, $adminLevelName);
        array_push($data, $AdminDiv);

        return  response()->json(['success' => true, 'data' => $data], 200);
    }

    public function getAdminDivImport(){
        return view('admin.pages.upload.admin_division');
    }
}