<?php

namespace App\Http\Controllers\Frontend;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public  function saveComment(Request $request){
        $comment =Comment::create([
           'user_id' => $request->user_id,
           'post_id' => $request->post_id,
           'comment' => $request->comment,
           'parent_id' => $request->parent_id,
           'status' => $request->status
        ]);

        $user=$comment->user;
        $avatarPath=asset('uploads/users/' . $user->avatar);
        return response()->json([
           'status'=>200,
           'msg' => 'comment has been added successfully',
           'comment' => $comment,
            'user'=>$user,
            'avatarPath' => $avatarPath
        ]);
    }


    public function delete(Request $request){

        $comment_id=$request->comment_id;
        $del=Comment::findOrFail($comment_id);
        $subdel=Comment::where('parent_id','=',$comment_id)->get();

        if($subdel->count() > 0){
            foreach ($subdel as $sub){
                $sub->delete();
            }
        }

        $del->delete();



        return response()->json(['status'=>200,
            'msg'=> 'comment has been deleted successfully',
            'id' => $request->comment_id
        ]);
    }



}
