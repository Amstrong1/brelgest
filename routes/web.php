<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\EmptyController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\PdfA4Controller;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\CurrentController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\InvLineController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatCliController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProformaController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\StatProdController;
use App\Http\Controllers\EmptySoonController;
use App\Http\Controllers\PdfTicketController;
use App\Http\Controllers\ProdFamilController;
use App\Http\Controllers\Admin\HomeController;

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

Route::get('/', HomeController::class)->middleware(['auth'])->name('home');

//dashboard routes
Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard', 'as' => 'admin.'], function () {
    //single action controllers
    Route::get('/', HomeController::class)->name('home');

    //link that return view, to get compoment from there
    Route::get('/users', [UserController::class, 'index'])->name('users');

    Route::group(['prefix' => 'edition', 'as' => 'edition.'], function () {
        Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
        Route::get('/product_group', [ProdFamilController::class, 'index'])->name('product_group');
        Route::get('/product', [ProductController::class, 'index'])->name('product');
        Route::get('/provider', [ProviderController::class, 'index'])->name('provider');
    });

    Route::group(['prefix' => 'statistique', 'as' => 'statistique.'], function () {
        Route::match(['get', 'post'], '/consumer', [StatCliController::class, 'index'])->name('consumer');
        Route::match(['get', 'post'], '/consumes', [StatProdController::class, 'index'])->name('consumes');
        Route::match(['get', 'post'], '/lines', [InvLineController::class, 'index'])->name('lines');
    });

    Route::group(['prefix' => 'stock', 'as' => 'stock.'], function () {
        Route::get('/alert', [AlertController::class, 'index'])->name('alert');
        Route::get('/current', [CurrentController::class, 'index'])->name('current');
        Route::get('/entries', [EntryController::class, 'index'])->name('entries');
        Route::get('/exits', [ExitController::class, 'index'])->name('exits');
        Route::get('/empty', [EmptyController::class, 'index'])->name('empty');
        Route::get('/empty_soon', [EmptySoonController::class, 'index'])->name('empty_soon');
    });

    Route::group(['prefix' => 'invoice', 'as' => 'invoice.'], function () {
        Route::get('/credit_note', [CreditController::class, 'index'])->name('credit_note');
        Route::get('/proforma', [ProformaController::class, 'index'])->name('proforma');
        Route::get('/canceling', [FactureController::class, 'cancel_invoice'])->name('cancel_invoice');
    });

    Route::resource('/invoice', FactureController::class);
    Route::get('/A4pdf/{fact}', [PdfA4Controller::class, 'index'])->name('pdfa4');
    Route::get('/Ticketpdf/{fact}', [PdfTicketController::class, 'index'])->name('pdfticket');

});


require __DIR__ . '/auth.php';
