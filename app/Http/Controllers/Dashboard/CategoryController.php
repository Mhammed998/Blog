<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller

{



    public function showAll(){
        $categories=Category::all();
        return view('dashboard.categories.all',['categories'=>$categories]);
    }


    public function create(){
        $cates=Category::all();
        return view('dashboard.categories.create',['cates'=>$cates]);
    }

    public function delete(Request $request){
        $category_id=$request->category_id;
        $del=Category::findOrFail($category_id);
        File::delete('uploads/categories/'.$del->cate_image);
        $del->delete();

        return response()->json(['status'=>200,
        'msg'=> 'category has been deleted successfully',
        'id' => $request->category_id
        ]);
    }

    public function store(Request $request){

        $validator=Validator::make($request->all(),[
           'cate_image' => 'sometimes|mimes:png,jpg,png,jpeg',
           'title' => 'required|string|min:3',
           'description' => 'required|string|min:5',
           'status' => 'required',
           'parent_id' => 'required'

        ]);

        if($validator->fails()){
            return response()->json(['status'=>400,'error'=>$validator->errors()->all()]);

        }else{

        //check if there's image
        if($request->hasFile('image')){
            $image=$request->image;
            $img_extension=$image->getClientOriginalExtension();
            $cate_image=time() . "." . $img_extension;
            $path='uploads/categories';
            $image->move($path,$cate_image);
        }else{
            $cate_image='';
        }

      $new=Category::create([
          'title'=> $request->title,
          'description' => $request->description,
          'cate_image' => $cate_image,
          'status' => $request->status,
          'parent_id' => $request->parent_id
      ]);

      if($new){
        return response()->json(['status'=>200,'msg'=>'category has been added successfully']);
      }else{
        return response()->json(['status'=>201,'msg'=>'category has not been added successfully']);
      }

    }

}


    public function edit(Request $request){
      $category_id=$request->category_id;
      $edit=Category::find($category_id);
      if(!$edit){
         return response()->json([
             'status' => 201,
             'msg' => 'No such category'
         ]);
        }
        else{
            return response()->json([
                'status' => 200,
                'category' => $edit
            ]);
        }
    }

    public function update(Request $request){
        $category_id=$request->category_id;
        $edit=Category::findOrFail($category_id);

        if($request->hasFile('image')){

            if(file_exists( public_path().'/uploads/categories/'. $edit->cate_image )){
                File::delete('uploads/categories/'.$edit->cate_image);
            }

            $image=$request->image;
            $img_extension=$image->getClientOriginalExtension();
            $cate_image=time() . "." . $img_extension;
            $path='uploads/categories';
            $image->move($path,$cate_image);

           $update= $edit->update([
                'title' => $request->title,
                'description' => $request->description,
                'cate_image' => $cate_image,
                'parent_id' =>$request->parent_id,
                'status' => $request->status
            ]);

        }else{
           $update= $edit->update([
                'title' => $request->title,
                'description' => $request->description,
                'parent_id' =>$request->parent_id,
                'status' => $request->status
            ]);
        }

        return response()->json([
            'status' => 200,
            'msg' => 'category has been updated successfully',
            'category' => $update
        ]);

    }










}
