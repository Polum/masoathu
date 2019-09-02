<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-11
 * Time: 5:01 PM
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Question;
class QuestionController extends Controller
{
    public function index()
    {
        return Question::where('created_at', '>', '2018-08-12 00:00:00')->orderBy('created_at', 'asc')->get();
    }

    public function show($id)
    {
        return Question::find($id);
    }

    public function store(Request $request)
    {
        return Question::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $Question = Question::findOrFail($id);
        $Question->update($request->all());

        return $Question;
    }

    public function delete(Request $request, $id)
    {
        $Question = Question::findOrFail($id);
        $Question->delete();

        return 204;
    }
}