<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $articles = Article::when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->with(['user','category'])->latest('id')->paginate(7);
        return view('welcome',compact('articles'));
    }

    public function detail($id){

        $article = Article::find($id);
        return view('blog.detail',compact('article'));

    }

    public function baseOnCategory($id){
        $articles = Article::when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->where('category_id',$id)->with(['user','category'])->latest('id')->paginate(7);
        return view('welcome',compact('articles'));
    }

    public function baseOnUser($id){
        $articles = Article::when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->where('user_id',$id)->with(['user','category'])->latest('id')->paginate(7);
        return view('welcome',compact('articles'));
    }

    public function baseOnDate($date){
        $articles = Article::when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->where('created_at',$date)->with(['user','category'])->latest('id')->paginate(7);
        return view('welcome',compact('articles'));
    }

}
