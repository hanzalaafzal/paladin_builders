<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TicketController;

use App\Http\Controllers\AuthenticationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('index')->get('/', function () {
    return view('index');
});

Route::get('/order/success',[OrderController::class,'orderSuccessPage'])->name('order.success');
Route::get('/order/fail',[OrderController::class,'orderFailurePage'])->name('order.fail');
Route::get('/thank/{ticket}',[OrderController::class,'thankyouPage'])->name('thankyou_page');
Route::get('/ticket/{ticket}',[TicketController::class,'showTicket'])->name('get.ticket');

Route::post('/order',[OrderController::class,'postDetails'])->name('order');

Route::get('login',function(){
  return view('panel.login');
});
Route::post('auth',[AuthenticationController::class,'auth'])->name('web.auth');


Route::prefix('admin')->middleware('auth')->group(function(){

});
