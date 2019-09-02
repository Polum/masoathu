<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-12
 * Time: 7:36 AM
 */

namespace App\Http\Controllers;

use App\Question_Type;
class QuestionTypeController extends Controller
{
    public function index()
    {
        return Question_Type::orderBy('id', 'asc')->get();
    }

    public function show($id)
    {
        return Question_Type::find($id);
    }

    public function store(Request $request)
    {
        return Question_Type::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $Question_Type = Question_Type::findOrFail($id);
        $Question_Type->update($request->all());

        return $Question_Type;
    }

    public function delete(Request $request, $id)
    {
        $Question_Type = Question_Type::findOrFail($id);
        $Question_Type->delete();

        return 204;
    }
}