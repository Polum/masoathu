<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-26
 * Time: 11:05 AM
 */

namespace App\Http\Controllers;

use App\Polling_Station;
use UTMRef;

class PollingStationController extends Controller
{

    public function index()
    {
        $pollingStations = array();
        foreach (Polling_Station::select('id', 'name', 'code', 'parent_id', 'x_coordinate', 'y_coordinate', 'parent_id')->with('administrativeDivisions.administrativeDivisionsParent.administrativeDivisionsParent.administrativeDivisionsParent')->with('administrativeDivisions')->cursor() as $singlePollingStation) {

            //convert the location from UTM to DD
            $utm1 = new UTMRef($singlePollingStation->x_coordinate, $singlePollingStation->y_coordinate, "L", 36);
            //$utm1->toLatLng();
            $singlePollingStation->y_coordinate = $utm1->toLatLng()->getLat();
            $singlePollingStation->x_coordinate = $utm1->toLatLng()->getLon();
            //$toSavePS = new Polling_Station();
            //$toSavePS = $singlePollingStation;
            //$toSavePS->save();
            array_push($pollingStations, $singlePollingStation);

        }
        return $pollingStations;
    }

    public function show($id)
    {
        return Polling_Station::find($id);
    }

    public function store(Request $request)
    {
        return Polling_Station::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $Polling_Station = Polling_Station::findOrFail($id);
        $Polling_Station->update($request->all());

        return $Polling_Station;
    }

    public function delete(Request $request, $id)
    {
        $Polling_Station = Polling_Station::findOrFail($id);
        $Polling_Station->delete();

        return 204;
    }

    public function getPollingStationsWithAdminDivs()
    {
        $pollingStations = array();
        foreach (Polling_Station::select('id', 'name', 'code', 'parent_id', 'x_coordinate', 'y_coordinate', 'parent_id')->with('administrativeDivisions')->cursor() as $singlePollingStation) {

            //convert the location from UTM to DD
            $utm1 = new UTMRef($singlePollingStation->x_coordinate, $singlePollingStation->y_coordinate, "L", 36);
            //$utm1->toLatLng();
            $singlePollingStation->y_coordinate = $utm1->toLatLng()->getLat();
            $singlePollingStation->x_coordinate = $utm1->toLatLng()->getLon();
            array_push($pollingStations, $singlePollingStation);

        }
        return Polling_Station::select('id', 'name', 'code', 'parent_id', 'x_coordinate', 'y_coordinate', 'parent_id')->with('administrativeDivisions.administrativeDivisionsParent.administrativeDivisionsParent.administrativeDivisionsParent')->with('administrativeDivisions')->get();
    }
}