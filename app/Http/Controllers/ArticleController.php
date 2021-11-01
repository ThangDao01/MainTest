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
    public function createArticle(Request $request){
        $obj = new Article();
        $obj->url = $request->get('url');
        $obj->thumbnail = $request->get('thumbnail');
        $obj->title = $request->get('title');
        $obj->category = $request->get('category');
        $obj->description = $request->get('description');
        $obj->detail = $request->get('detail');
        $obj->source = $request->get('source');
        $obj->save();
    }
    public function update($id, Request $request)
    {
        $obj = Article::find($id);
        $obj->url = $request->get('url');
        $obj->thumbnail = $request->get('thumbnail');
        $obj->title = $request->get('title');
        $obj->category = $request->get('category');
        $obj->description = $request->get('description');
        $obj->detail = $request->get('detail');
        $obj->source = $request->get('source');
        $obj->save();
    }
    public function export_csv()
    {
        return Excel::download(new ArticleExport() , 'article.xlsx');
    }
    public  function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new Imports, $path);
        return 'done';
    }
}
