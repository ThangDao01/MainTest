<?php

namespace App\Http\Controllers;

use App\Imports\Imports;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Exports\ArticleExport;
use Maatwebsite\Excel\Facades\Excel;

class ArticleController extends Controller
{
    //
    public function listArticle(){
        return view('article-list',[
            'listArticle' => Article::all(),
        ]);
    }
    public function export_csv(){
        return Excel::download(new ArticleExport() , 'product.xlsx');
    }
    public  function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new Imports, $path);
        return back();
    }
}
