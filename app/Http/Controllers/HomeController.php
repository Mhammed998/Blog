<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{




    public function index()
    {
        $categories=Category::all();
        $posts=post::all();
        return view('home',[
            'categories'=>$categories , 
            'posts' => $posts
            ]);
    }












}
