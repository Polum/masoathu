<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-10
 * Time: 7:31 AM
 */

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Incident;

class IncidentController extends Controller
{
    public function index()
    {
        return Incident::orderBy('id', 'asc')->get();
    }

    public function show($id)
    {
        return Incident::find($id);
    }

    public function store(Request $request)
    {
        return Incident::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $Incident = Incident::findOrFail($id);
        $Incident->update($request->all());

        return $Incident;
    }

    public function delete(Request $request, $id)
    {
        $Incident = Incident::findOrFail($id);
        $Incident->delete();

        return 204;
    }
}