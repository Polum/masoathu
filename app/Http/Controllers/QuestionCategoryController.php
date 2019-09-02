<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-11
 * Time: 4:52 PM
 */

namespace App\Http\Controllers;
use App\Question_Category;


class QuestionCategoryController extends Controller
{
    public function index()
    {
        return Question_Category::orderBy('id', 'asc')->get();
    }

    public function show($id)
    {
        return Question_Category::find($id);
    }

    public function store(Request $request)
    {
        return Question_Category::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $Question_Category = Question_Category::findOrFail($id);
        $Question_Category->update($request->all());

        return $Question_Category;
    }

    public function delete(Request $request, $id)
    {
        $Question_Category = Question_Category::findOrFail($id);
        $Question_Category->delete();

        return 204;
    }
}