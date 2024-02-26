<?php

namespace App\Http\Controllers;
use App\Exports\UsersExport;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportInquiries extends Controller
{
    //
    public function export() 
    {
        return Excel::download(new UsersExport, 'inquiries.xlsx');
    }
       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        $validatedData = $request->validate([
 
            'file' => 'required',
  
         ]);
         
        Excel::import(new UsersImport,request()->file('file'));
               
        return redirect('/viewinquiries')->with('message', 'Inquiries Successfully uploaded.');
    }
}
