<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-05
 * Time: 3:23 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Excel;
use App\Admin_Division_Level;
use App\Admin_Division;
use App\Polling_Station;
use App\Observer;
use App\Question;
use AdminDivision;

class ExcelController extends Controller
{
    public function uploadExcel(Request $request)
    {
        ini_set('max_execution_time', 180);
        if ($request->hasFile('import_file')) {
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                $adminDivisionLevels = Admin_Division_Level::all();
                $namesArray = Array();
                $divisionLEvelsCount = $adminDivisionLevels->count();
                $count = 0;
                foreach ($adminDivisionLevels as $level) {

                    array_push($namesArray, $level->name);
                    foreach ($reader->toArray() as $key => $row) {
                        //dd($row);
                        //create an array with arrays for each administrative division and store each record in an object instance but for no just insert the values on at a time
                        //insert each level at a time

                        if ($level->id != 1) {
                            //echo $level->id;
                            $currentDivisionFindQuery = Admin_Division::where([
                                ['name', '=', $row[strtolower($level->name). '_name']],
                                ['code', '=', $row[strtolower($level->name) . '_code']]
                            ])->get();
                            if($currentDivisionFindQuery->count() < 1 ){
                                $parentDivisionFindQuery = Admin_Division::where('name', "=", [$row[strtolower($namesArray[sizeof($namesArray) - 2]) . '_name']])->get();
                                foreach ($parentDivisionFindQuery as $adminDivision) {
                                    $returnedDivId = $adminDivision->id;
                                    $returnedDivCode = $adminDivision->code;
                                }
                                if (isset($returnedDivId) ) {
                                    $insertQueryArray = array('name' => $row[strtolower($level->name) . '_name'], 'code' => $row[strtolower($level->name) . '_code'], 'parent_id' => $returnedDivId, 'level_id' => $level->id, 'x_coordinate' => $row['xcoord_' . strtolower($level->name)], 'y_coordinate' => $row['ycoord_' . strtolower($level->name)]);
                                    Admin_Division::create($insertQueryArray);
                                } else {
                                    //echo "the returned ID was not found";
                                }
                            } else{
                                //echo "The ".$namesArray[sizeof($namesArray)-1]." ".$level->name." has already been inserted <br />";
                            }

                        } else {
                            $divisionFindQuery = Admin_Division::where('name', '=', [$row[strtolower($namesArray[sizeof($namesArray) - 1]) . '_name']])->get();
                            if ($divisionFindQuery->count() < 1) {

                                $insertQueryArray = array('name' => $row[strtolower($level->name) . '_name'], 'code' => $row[strtolower($level->name) . '_code'], 'parent_id' => 0, 'level_id' => $level->id, 'x_coordinate' => $row['xcoord_' . strtolower($level->name)], 'y_coordinate' => $row['ycoord_' . strtolower($level->name)]);
                                Admin_Division::create($insertQueryArray);
                            }else{
                                //echo "The Region ".$level->name." has already been inserted <br />";
                            }

                        }

                    }
                }

                //insert the centers/poling stations
                foreach ($reader->toArray() as $key => $row) {
                    $currentDivisionFindQuery = Admin_Division::where('code', '=', $row['centre_code'])->get();
                    if($currentDivisionFindQuery->count() < 1 ){
                        $parentDivisionFindQuery = Admin_Division::where('name', "=", [$row[strtolower($namesArray[sizeof($namesArray) - 1]) . '_name']])->get();
                        foreach ($parentDivisionFindQuery as $adminDivision) {
                            $returnedDivId = $adminDivision->id;
                            $returnedDivCode = $adminDivision->code;
                        }
                        if (isset($returnedDivId) ) {
                            $insertQueryArray = array('name' => $row['centre_name'], 'code' => $row['centre_code'], 'parent_id' => $returnedDivId, 'x_coordinate' => $row['xcoord_centre'], 'y_coordinate' => $row['ycoord_centre']);
                            Polling_Station::create($insertQueryArray);
                        } else {
                            echo "the returned ID was not found";
                        }
                    } else{
                        echo "The ".$namesArray[sizeof($namesArray)-1]." ".$level->name." has already been inserted <br />";
                    }
                }
            });
            Session::put('success', 'Your file successfully import in database!!!');

            return "Success!!";
        } else {
            return "not Uploaded";
        }


    }
    public function uploadObservers(Request $request){
        if ($request->hasFile('import_file')) {
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {

                foreach ($reader->toArray() as $key => $row) {
                    //print_r($row);
                    Observer::create($row);
                }

            });
            return back();
        }

    }
    public function uploadQuestions(Request $request){
        if ($request->hasFile('import_file')) {
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {

                foreach ($reader->toArray() as $key => $row) {
                    //print_r($row);
                    Question::create($row);
                }

            });
            return back();
        }

    }
}
