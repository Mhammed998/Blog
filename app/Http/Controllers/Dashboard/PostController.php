<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{


    public function showAll(){
        $posts=Post::all();
        $categories=Category::all();
        return view('dashboard.posts.all' , ['posts'=>$posts , 'categories'=>$categories]);
    }


    public function create(){
     $categories=Category::all();
     $tags=Tag::all();
     return view('dashboard.posts.create',['cates'=>$categories , 'tags'=>$tags]);
    }

    public function delete(Request $request){
        $post_id=$request->post_id;
       $del=Post::findOrFail($post_id);
       File::delete('uploads/posts/'.$del->image);
       $del->delete();
         return response()->json(['status'=>200,
         'msg'=>'post deleted successfully',
         'id'=>$post_id
         ]);

    }



    public function store(Request $request){


        $validator=Validator::make($request->all(),[
            'title' => 'required|string|min:5',
            'content' => 'required|string|min:10',
            'image' => 'sometimes|mimes:png,jpg,png,jpeg',
            'status' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'tags' =>'required'


         ]);

         if($validator->fails()){
             return response()->json(['status'=>400,'error'=>$validator->errors()->all()]);

         }else{


            $file_name='';
            if($request->hasFile('image')){
            //save photo in uploads/posts folder
            $file_extension= $request->image->getClientOriginalExtension();
            $file_name=time() . "." .$file_extension;
            $path='uploads/posts';
            $request->image->move($path,$file_name);
            }


                $new=Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $file_name,
                'status' => $request->status,
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                ]);

                $new->tags()->sync($request->input('tags'));


                if($new){
                return response()->json(['status'=>200,'msg'=>'post created successfully','post'=>$new]);
                }else{
                return response()->json(['status'=>201,'msg'=>'post not created successfully']);
                }


         }



    }


    public function edit($post_id){
     $post=Post::findOrFail($post_id);
     $tags=Tag::all();
     $cates=Category::all();
     $selected_tags=array();
     $post=Post::findOrFail($post_id);
     foreach($post->tags as $post_tag){
       array_push($selected_tags,$post_tag->id);
     }
     return view('dashboard.posts.edit' , [
         'post' => $post,
         'tags' => $tags,
         'cates' => $cates,
         'selectedTags' => $selected_tags
         ]);
    }


    public function update(Request $request){


        $validator=Validator::make($request->all(),[
            'title' => 'required|string|min:5',
            'content' => 'required|string|min:10',
            'image' => 'sometimes|mimes:png,jpg,png,jpeg',
            'status' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'tags' =>'required'


         ]);

         if($validator->fails()){
             return response()->json(['status'=>400,'error'=>$validator->errors()->all()]);

         }else{

            $post_id=$request->post_id;
            $updated=Post::findOrFail($post_id);
            if($request->hasFile('image')){

            if(file_exists( public_path().'/uploads/posts/'. $updated->image )){
                File::delete('uploads/posts/'. $updated->image);
            }
            //save photo in uploads/posts folder
            $file_extension= $request->image->getClientOriginalExtension();
            $file_name=time() . "." .$file_extension;
            $path='uploads/posts';
            $request->image->move($path,$file_name);

            $post_id=$request->post_id;
            $updated=Post::findOrFail($post_id);
             $updated->update([
             'title' => $request->title,
             'content' => $request->content,
             'image' => $file_name,
             'status' => $request->status,
             'user_id' => $request->user_id,
             'category_id' => $request->category_id,
             ]);

             $updated->tags()->sync($request->input('tags'));

            }

               $post_id=$request->post_id;
               $updated=Post::findOrFail($post_id);
                $updated->update([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                ]);

                $updated->tags()->sync($request->input('tags'));

                if($updated){
                return response()->json(['status'=>200,'msg'=>'post updated successfully','post'=>$updated]);
                }else{
                return response()->json(['status'=>201,'msg'=>'post not updated successfully']);
                }


         }



    }







}
