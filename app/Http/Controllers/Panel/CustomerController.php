<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class CustomerController extends Controller
{
    public function viewCustomers(){
      return view('panel.pages.view_customer');
    }

    public function ajaxCustomers(){
      $data=DB::table('customers')->leftjoin('users','added_by','=','users.id')->select('customers.*','users.name')->orderBy('customer_id','DESC');
      return DataTables::queryBuilder($data)->toJson();
    }
}
