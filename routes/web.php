<?php

use App\Http\Controllers\ArticleController;
use App\Models\Article;
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

Route::get('/', [ArticleController::class,'listArticle']);
Route::get('/test',function (){
    $resultExcel = Article::select(['url','thumbnail','title','category','description','detail','source'])->get();
    return $resultExcel;
});
Route::get('/listArticle', [ArticleController::class,'listArticle']);

Route::post('/export-csv',[ArticleController::class,'export_csv']);
Route::post('/import-csv',[ArticleController::class,'import_csv']);
