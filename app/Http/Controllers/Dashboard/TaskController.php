<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{


 public function showTasks(){
    $tasks=Task::all();
    return view('dashboard.home',['tasks'=>$tasks]);
 }


public function delete(Request $request){
        $task_id=$request->task_id;
        $del=Task::findOrFail($task_id);
        $del->delete();

        return response()->json(['status'=>200,
        'msg'=> 'Task has been deleted successfully',
        'id' => $task_id
        ]);
}



  public function store(Request $request){


    $validator=Validator::make($request->all(),[
        'task' => 'required|min:3',
        'done' => 'sometimes',

     ]);

     if($validator->fails()){
         return response()->json(['status'=>400,'error'=>$validator->errors()->all()]);

     }else{

        $new=Task::create([
            'task'=> $request->task,
            'done' => 'no'
        ]);

        if($new){
          return response()->json(['status'=>200,
          'msg'=>'task has been added successfully',
          'task' => $new
          ]);
        }else{
          return response()->json(['status'=>201,
          'msg'=>'tag has not been added successfully']);
        }

     }




  }



  public function taskIsDone(Request $request){
      $task_id=$request->task_id;
      $task=Task::find($task_id);

      if($task){

        if($task->done == "yes"){
            $task->update(['done' => 'no']);
        }else{
            $task->update(['done' => 'yes']);
        }

        $task->fresh();

          return response()->json([
           'status'=>200,
           'msg'=>'task status has been updated successfully',
           'task_id'=>$task_id ,
           'task'=>$task
          ]);

      }else{
          return response()->json(['status'=>201,'msg'=>'task status has not been updated']);
      }
  }







}
