<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function importExportView(){
        return view('admin_view/product_csv_view');
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function export()
    {
        return Excel::download(new ProductExport, 'All_Products_List.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        Excel::import(new ProductImport,request()->file('file'));

        return back();
    }


} // end of controller


