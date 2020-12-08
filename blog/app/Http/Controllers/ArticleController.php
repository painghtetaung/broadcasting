<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth')->except(['index', 'detail']);
    }


    public function index()
    {
        $data = Article::latest()->paginate(5);

        return view('articles.index',[
            'articles' => $data
        ]);
    }

    public function detail(Article $article)
    {
        return view('articles.detail', compact('article'));
    }

    public function add()
    {   
        $categories = Category::all();
        return view('articles.add', compact('categories'));
    }

    public function create()
    {
         $validator = validator (request()->all(), [
            
             'title' => 'required',
             'body' => 'required',
             'category_id' => 'required'               
         ]);
         
         if($validator->fails()) {
             return back()->withErrors($validator);
         }
         $article = new Article();
         $article->title = request()->title;
         $article->user_id = auth()->user()->id;
         $article->body = request()->body;
         $article->category_id = request()->category_id;
         $article->save();

         return redirect('/articles');
    }

    public function delete(Article $article)
    {
        $article->delete();

        return redirect('/articles')->with('info', 'Article deleted');
    }
}
