<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function viewWiner(){
      return view('event_win');
    }
}
