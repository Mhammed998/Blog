<?php

namespace App\Http\Controllers\Dashboard;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CommentController extends Controller
{




public function showAll(){
    $comments=Comment::all();
    return view('dashboard.comments.all',['comments' => $comments]);
}



public function delete(Request $request){
    $comment_id=$request->comment_id;
    $del=Comment::findOrFail($comment_id);
    $del->delete();

    return response()->json(['status'=>200,
    'msg'=> 'Comment has been deleted successfully',
    'id' => $comment_id
    ]);
}









}
