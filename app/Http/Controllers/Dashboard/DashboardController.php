<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\Task;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


   public function index(){
       $categories=Category::all();
       $users=User::all();
       $posts=Post::all();
       $comments=Comment::all();
       $tags=Tag::all();
       $tasks=Task::all();
        return view('dashboard.dashboard',[
            'categories' => $categories,
            'users' =>$users,
            'posts' =>$posts,
            'comments'=>$comments,
            'tags' => $tags,
            'tasks' => $tasks
        ]);
   }
















}
