<?php

namespace App\Http\Controllers\Dashboard;

use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{


  public function showAll(){
    $tags=Tag::all();
    return view('dashboard.tags.all',['tags'=>$tags]);
  }


public function delete(Request $request){
    $tag_id=$request->tag_id;
    $del=Tag::findOrFail($tag_id);
    $del->delete();

    return response()->json(['status'=>200,
    'msg'=> 'tag has been deleted successfully',
    'id' => $tag_id
    ]);
}


public function store(Request $request){


    $validator=Validator::make($request->all(),[
        'name' => 'required|min:2',
        'link' => 'sometimes',

     ]);

     if($validator->fails()){
         return response()->json(['status'=>400,'error'=>$validator->errors()->all()]);

     }else{

        $new=Tag::create([
            'name'=> $request->name,
            'link' => $request->link

        ]);

        if($new){
          return response()->json(['status'=>200,'msg'=>'tag has been added successfully']);
        }else{
          return response()->json(['status'=>201,'msg'=>'tag has not been added successfully']);
        }
     }


}



    public function edit(Request $request){
     $tag_id=$request->tag_id;
     $tag=Tag::where('id','=',$tag_id)->get();

     if($tag){
         return response()->json([
             'status' => 200,
             'tag' => $tag
         ]);
     }else{
         return response()->json([
             'status' => 201,
             'msg' => 'no such tag'
         ]);
     }



    }



    public function update(Request $request){
        $tag_id=$request->id;
        $edit=Tag::findOrFail($tag_id);

           $update= $edit->update([
                'name' => $request->name,
                'link' => $request->link
            ]);

        return response()->json([
            'status' => 200,
            'msg' => 'tag has been updated successfully',
            'tag' => $update
        ]);

    }









}
