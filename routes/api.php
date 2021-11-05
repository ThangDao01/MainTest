<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticleController;
use App\Models\Account;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('test',[AccountController::class, 'test']);

Route::get('article', function () {
    // Let's return fake information.
    return [
        'data' => Article::all(),
    ];
});
Route::get('account/data', function () {
    // Let's return fake information.
    return [
        'data' => Account::all(),
    ];
});
Route::get('news/{id}',function ($id){
    return Article::find($id);
});

Route::post('export-csv',[ArticleController::class,'export_csv']);
Route::post('import-csv',[ArticleController::class,'import_csv']);

Route::post('article/create',[ArticleController::class,'createArticle']);
Route::post('article/update/{id}', [ArticleController::class,'update']);

Route::get('user', [AccountController::class, 'userInformation']);

//login
Route::post('login', [AccountController::class, 'LoginPost']);

//register
Route::post('register', [AccountController::class, 'RegisterPost']);


Route::get('account/new-password/{email}', [AccountController::class, 'new_Password']);
Route::post('account/reset-password/{email}', [AccountController::class, 'rs_Password']);

//Route::middleware('auth:sanctum')->get('/user', function (Request $request){
//    return $request->user();
//});
