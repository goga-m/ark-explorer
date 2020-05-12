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

/*
 * Detail transaction page.
 */
Route::get('/transaction/{id}', function ($id) {
    return view('transaction', ['id' => $id]);
});

/*
 * Wallets list.
 */
Route::get('/wallets/', function () {
    return view('wallets', ['page' => 1]);
});

/*
 * Wallets list (selected page).
 */
Route::get('/wallets/{page}', function ($page) {
    return view('wallets', ['page' => $page]);
});

/*
 * Wallet detail page.
 */
Route::get('/wallet/{walletAddress}', function ($walletAddress) {
    return view('wallet', ['walletAddress' => $walletAddress, 'page' => 1, 'transactionType' => 'all']);
});

/*
 * Wallet detail page with transactions pager.
 */
Route::get('/wallet/{walletAddress}/transactions/{type}/{page}', function ($walletAddress, $type, $page) {
    return view('wallet', ['walletAddress' => $walletAddress, 'transactionType' => $type, 'page' => $page]);
});

/*
 * Delegates list.
 */
Route::get('/delegates/', function () {
    return view('delegates', ['page' => 1]);
});

/*
 * Delegates list ().
 */
Route::get('/delegates/{page}', function ($page) {
    return view('delegates', ['page' => $page]);
});
