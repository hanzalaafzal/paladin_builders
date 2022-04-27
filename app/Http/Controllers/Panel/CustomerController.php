<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function viewCustomers(){
      return view('panel.pages.view_customer');
    }

    public function ajaxCustomers(){
      $data=DB::table('customers')->leftjoin('users','added_by','=','users.id')->select('customers.*','users.name')->orderBy('customer_id','DESC');
      return DataTables::queryBuilder($data)->toJson();
    }

    public function uploadCSV(Request $req){
      // dd($req->all());
      $req->validate([
        'file' => 'file'
      ],[

        'file.file' => 'Please upload csv file only.',
      ]);
      $fileExt=$req->file->getClientOriginalExtension();
      if(Str::upper($fileExt) != 'CSV'){
        return redirect()->back()->withError(['error'=>'Please upload csv file only.']);
      }

      try{
        Excel::import(new CustomerImport, request()->file('file'),null, \Maatwebsite\Excel\Excel::CSV);
        session()->flash('success','Record added');
        return redirect()->back();
      }catch(\Exception $ex){
        dd($ex->getMessage());
      }

    }


}
