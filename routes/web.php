<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MailController;
use App\Models\Account;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/', [ArticleController::class, 'listArticle']);
//Route::get('/test', [MailController::class,'registerMail']);
Route::get('/test', function () {
    if (Account::where('email', '=', 'thangdao202@gmail.com')->where('Status', '=', 1)->first()) {
        return 'đã login';
    }
    return 'chưa login';
});

Route::get('/listArticle', [ArticleController::class, 'listArticle']);

//Route::get('/export-csv',[ArticleController::class,'export_csv']);
//Route::post('/import-csv', [ArticleController::class, 'import_csv']);

Route::get('/account/list', [AccountController::class, 'listAccount']);

//login
Route::get('/account/login', [AccountController::class, 'LoginForm']);
//Route::post('/account/login', [AccountController::class, 'LoginPost']);
//
////register
Route::get('/account/register', [AccountController::class, 'RegisterForm']);
//Route::post('/account/register', [AccountController::class, 'RegisterPost']);

//Account Action

Route::get('/enter-email', [AccountController::class, 'enter_Email_Form']);
Route::post('/enter-email', [AccountController::class, 'enter_Email']);
Route::get('/rs-pass/{email}', [AccountController::class, 'rs_Password_Form']);
Route::post('/rs-pass/{email}', [AccountController::class, 'rs_Password']);


Route::get(
    '{uri}',
    '\\' . Pallares\LaravelNuxt\Controllers\NuxtController::class
)->where('uri', '.*');

