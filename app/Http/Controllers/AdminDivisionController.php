<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-23
 * Time: 2:08 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin_Division;
class AdminDivisionController extends Controller
{
    public function index()
    {
        return Admin_Division::select('id', 'name','code', 'parent_id', 'level_id')->with('lowerAdmin.lowerAdmin.lowerAdmin')->get();
    }

    public function show($id)
    {
        return Admin_Division::find($id);
    }

    public function store(Request $request)
    {
        return Admin_Division::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $Admin_Division = Admin_Division::findOrFail($id);
        $Admin_Division->update($request->all());

        return $Admin_Division;
    }

    public function delete(Request $request, $id)
    {
        $Admin_Division = Admin_Division::findOrFail($id);
        $Admin_Division->delete();

        return 204;
    }
}