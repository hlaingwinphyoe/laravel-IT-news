<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $all = Article::all();
//        foreach($all as $a){
//            $a->slug = Str::slug($a->title.'-'.uniqid());
//            $a->update();
//        }

        $articles = Article::when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->with(['user','category'])->latest('id')->paginate(7);
        return view("article.index",compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("article.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "category" => "required|exists:categories,id",
            "title" => "required|min:3|max:200",
            "description" => "required|min:5",
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->slug = Str::slug($request->title.'-'.uniqid());
        $article->description = $request->description;
        $article->category_id = $request->category;
        $article->user_id = Auth::id();
        $article->save();

        return redirect()->route("article.index")->with("message","New Article Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view("article.show",compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view("article.edit",compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            "category" => "required|exists:categories,id",
            "title" => "required|min:3|max:200",
            "description" => "required|min:5",
        ]);

        $article->title = $request->title;
        $article->slug = Str::slug($request->title.'-'.uniqid());
        $article->description = $request->description;
        $article->category_id = $request->category;

        $article->update();

        return redirect()->route("article.index")->with("message","Article Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {

        $article->delete();

        // not good solution but bug fixed
        return redirect()->route("article.index",['page' => request()->page])->with('message',"Article Deleted");


        // good solution  // paginate နဲ့ delete ဖျက်ရင် လက်ရှိ paginate page နေရာကို ပြန်ညွှန်တာ
//        return redirect()->back()->with('message',"Article Deleted");
    }
}
