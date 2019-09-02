<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-05
 * Time: 1:03 PM
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
/*use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Excel;*/

class ExcelControllerold extends Controller
{
    public function importExport()
    {
        return view('importExport');
    }
    public function downloadExcel($type)
    {
        $data = Post::get()->toArray();
        return Excel::create('laravelcode', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
    public function importExcel(Request $request)
    {
        return $request;
        /*if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['title'] = $row['title'];
                    $data['description'] = $row['description'];

                    if(!empty($data)) {
                        DB::table('post')->insert($data);
                    }
                }
            });
        }

        Session::put('success', 'Your file successfully import in database!!!');

        return back();*/
    }
}