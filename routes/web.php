<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Panel\CustomerController;
use App\Http\Controllers\Panel\TicketsController;
use App\Http\Controllers\Panel\SalesmanController;
use App\Http\Controllers\EventController;


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
    return view('index2');
});

Route::get('/order/success',[OrderController::class,'orderSuccessPage'])->name('order.success');
Route::get('/order/fail',[OrderController::class,'orderFailurePage'])->name('order.fail');
Route::get('/thank',[OrderController::class,'thankyouPageIBFT'])->name('thankyou_page');
Route::get('/ticket/{ticket}',[TicketController::class,'showTicket'])->name('get.ticket');
Route::get('/ref/{link}',[TicketController::class,'referalTicket']);

Route::post('/order',[OrderController::class,'postDetails'])->name('order');

Route::name('login')->get('login',function(){
  return view('panel.login');
});
Route::post('auth',[AuthenticationController::class,'auth'])->name('web.auth');


Route::prefix('admin')->middleware('auth:admin')->group(function(){

    Route::prefix('ajax')->group(function(){
      Route::get('customers',[CustomerController::class,'ajaxCustomers'])->name('ajax.customers');
      Route::get('tickets',[TicketsController::class,'ajaxTickets'])->name('ajax.tickets');
    });


    Route::get('/salesman',[SalesmanController::class,'viewSalesman'])->name('get.salesman');
    Route::get('/saleman/update/{id}/{status}',[SalesmanController::class,'updateSalesMan'])->name('update.salesman');
    Route::post('/salesman',[SalesmanController::class,'storeSalesMan'])->name('post.salesman');


    Route::get('dashboard',[AuthenticationController::class,'viewDashboard'])->name('get.dashboard');
    Route::get('/customers',[CustomerController::class,'viewCustomers'])->name('get.customer');
    Route::post('/upload/customers',[CustomerController::class,'uploadCSV'])->name('upload.csv');
    Route::post('/customer/new',[CustomerController::class,'newCustomer'])->name('customer.post');

    Route::get('/tickets',[TicketsController::class,'viewTickets'])->name('get.tickets');
    Route::get('/update/{ticket}/{status}',[TicketsController::class,'updateTicket'])->name('update.ticket');
});

Route::get('/events',function(){
  return view('event');
});

Route::get('/winner',[EventController::class,'viewWiner']);
