<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-09
 * Time: 2:03 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Sms;

class SMSApiController extends Controller
{
    public function index()
    {
        return Sms::all();
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