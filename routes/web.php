<?php

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


/*
 * Show blocks on home page.
 */
Route::get('/', function () {
    return view('blocks', ['page' => 1]);
});

/*
 * Blocks page. Read page count from url
 */
Route::get('/blocks/{page}', function ($page) {
    return view('blocks', ['page' => $page]);
});

/*
 * Detail block page.
 */
Route::get('/block/{id}', function ($id) {
    return view('block', ['id' => $id]);
});

/*
 * Transactions page, first page.
 */
Route::get('/transactions', function () {
    return view('transactions', ['page' => 1]);
});

/*
 * Transactions page. Read page count from url
 */
Route::get('/transactions/{page}', function ($page) {
    return view('transactions', ['page' => $page]);
});
