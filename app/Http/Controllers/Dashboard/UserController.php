<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


    use RegistersUsers;


    public function profile($profile_id){
      $profile=User::findOrFail($profile_id);
      return view('dashboard.users.profile',['profile'=>$profile]);
    }


    public function showAll(){
       $users=User::all();
       return view('dashboard.users.all' , ['users'=>$users]);
    }


    public function showUser($userid){
        $user=User::findOrFail($userid);
        return view('dashboard.users.show',['user' => $user]);
    }


    public function delete(Request $request){
        $user_id=$request->user_id;
       $del=User::findOrFail($user_id);
       File::delete('uploads/users/'.$del->avatar);
       $del->delete();
         return response()->json(['status'=>200,
         'msg'=>'user has been deleted successfully',
         'id'=>$user_id
         ]);

    }



    public function changeStatus(Request $request){
      $user_id=$request->user_id;
      $user=User::where('id','=',$user_id);
      $user->update(['status'=>$request->user_status]);



     if($user){
      return response()->json(['status'=>200,
      'msg'=>'userStatus has been updated successfully',
      'id'=>$user_id,
      'userStatus' => $request->user_status
      ]);
     }else{
        return response()->json(['status'=>201,
        'msg'=>'userStatus has not been updated successfully'
        ]);
     }

    }



  public function changeType(Request $request){
        $user_id=$request->user_id;
        $user=User::where('id','=',$user_id);
        $user->update(['type'=>$request->user_type]);



       if($user){
        return response()->json(['status'=>200,
        'msg'=>'userType has been updated successfully',
        'id'=>$user_id,
        'userStatus' => $request->user_type
        ]);
       }else{
          return response()->json(['status'=>201,
          'msg'=>'userType has not been updated successfully'
          ]);
       }

  }



  public function update(Request $request){

    $profile_id=$request->profile_id;
    $profile=User::findOrFail($profile_id);

    $validator=Validator::make($request->all(),[
        'full_name' => 'required|string|min:5',
        'email' => 'required|string|min:10',
        'mobile' => 'sometimes',
        'status' => 'required',
        'avatar' => 'sometimes|mimes:png,jpg,png,jpeg:',
        'description' => 'sometimes|string|min:5',
        'type' => 'required'


     ]);

     if($validator->fails()){
         return response()->json(['status'=>400,'error'=>$validator->errors()->all()]);

     }else{

        $file_name='';
        if($request->hasFile('avatar')){
        //save photo in uploads/posts folder
        $file_extension= $request->avatar->getClientOriginalExtension();
        $file_name=time() . "." .$file_extension;
        $path='uploads/users';
        $request->avatar->move($path,$file_name);
        }

        $profile->update([
          'full_name' => $request->full_name,
          'email' => $request->email,
          'mobile' => $request->mobile,
          'status' =>$request->status,
          'avatar' => $file_name,
          'description' => $request->description,
          'type' => $request->type
        ]);

        return response()->json([
        'status'=>200,
        'msg'=>'user has been updated successfully',
        'profile' => $profile
        ]);

     }


  }








}
