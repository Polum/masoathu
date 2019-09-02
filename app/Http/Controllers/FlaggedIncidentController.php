<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fagged_Incident;

class FlaggedIncidentController extends Controller
{
    public function index()
    {
        return Fagged_Incident::with('report')->orderBy('id', 'asc')->get();
    }

    public function show($id)
    {
        return Fagged_Incident::find($id);
    }

    public function store(Request $request)
    {
        //return $request;
        return Fagged_Incident::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $Fagged_Incident = Fagged_Incident::findOrFail($id);
        $Fagged_Incident->update($request->all());

        return $Fagged_Incident;
    }

    public function delete(Request $request, $id)
    {
        $Fagged_Incident = Fagged_Incident::findOrFail($id);
        $Fagged_Incident->delete();

        return 204;
    }
}
