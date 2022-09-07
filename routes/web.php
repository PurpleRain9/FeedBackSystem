<?php

use App\Http\Controllers\NotiAlertController;
use Illuminate\Support\Facades\Route;

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


Route::get('/' ,[NotiAlertController::class ,'view']);
Route::get('/webview', [NotiAlertController::class, 'webview'])->name('feedback.webview');

// feedback create
Route::post('/create-feedback', [NotiAlertController::class, 'create'])->name('feedback.create');

// feedback cout echart
Route::get('/feedback-data', [NotiAlertController::class, 'showData'])->name('feedback.datashwow');

// lineChart exal export
Route::get('/monthlySearchChart',[NotiAlertController::class, 'monthlySearchChart'])->name('monthly.searchChart');
Route::get('/dailySearchChart', [NotiAlertController::class,'dailySearchChart'])->name('daily.searchChart');
Route::get('/fromtoMonthSearch', [NotiAlertController::class, 'fromtoSearch'])->name('month.search');
Route::get('/fromtoDailySearch', [NotiAlertController::class, 'dailySearch'])->name('daily.search');
Route::get('/exportExcel', [NotiAlertController::class, 'exportExcel'])->name('data.exportExcel');
Route::get('/dailyExcel', [NotiAlertController::class, 'dailyExcel'])->name('data.dailyExcel');  
Route::get('/yearlyExcel', [NotiAlertController::class, 'yearlyExcel'])->name('data.yearlyExcel');
Route::get('/yearSearch' , [NotiAlertController::class, 'yearSearch'])->name('year.search');
Route::get('/test', [NotiAlertController::class, 'test'])->name('test');
