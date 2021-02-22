<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ctlDatatable;
use Illuminate\Support\Facades\Schema;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('test', function (Request $request) {

    return  view('phpgetjson');
 });
 Route::get('data', [ctlDatatable::class, 'test_data']);


 Route::get('test_db', function (Request $request) {

    $columns = Schema::getColumnListing('model_datatables'); // users table
    dd($columns); // dump the result and die
 });
