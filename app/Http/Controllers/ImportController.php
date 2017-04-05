<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Item;

class ImportController extends Controller
{
    public function importExcel(Request $request)
    {


            $path = $request->file('import_file')->getRealPath();

            $data = Excel::load($path, function($reader) {})->get();

            if(!empty($data) && $data->count()){

                    return back()->with('success','Insert Record successfully.');

            }


        return back()->with('error','Please Check your file, Something is wrong there.');
    }
}
