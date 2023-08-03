<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMyAllTask(Request $request)
    {
        $task = Task::where('user_id' , $request->user_id)->get();
        return response()->json($task);
    }

    public function showEmployeeAllTask(Request $request){
        $task = Task::where('employee_id' , $request->employee_id)->get();

        return response()->json($task);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newTask(Request $request)
    {
        $request->validate([             
            "title" =>"required|string|min:3",
            "description"=> "required|min:10",
            "user_id" => "required",
            "employee_id" => "required"
        ]);
        $user = Task::create([
            'title' => $request->title,
            'description'=> $request->description,
            'unagree_descrition'=> $request->unagree_descrition,
            'user_id' => $request->user_id,
            'employee_id' => $request->employee_id,

        ]);
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMyWaitTask(Request $request)
    {
        $task = Task::where([
            ['wait_task' , '=', 1],
            ['user_id' , $request->user_id]
        ])->get();
        return response()->json($task);
    }


    public function showMyagreeTask(Request $request)
    {
        $task = Task::where([
            ['agree_task' , '=', 1],
            ['user_id' , $request->user_id]
        ])->get();
        return response()->json($task);
    }

    public function showMyUnagreeTask(Request $request)
    {
        $task = Task::where([
            ['unagree_task' , '=', 1],
            ['user_id' , $request->user_id]
        ])->get();
        return response()->json($task);
    }

    public function showMyDoneTask(Request $request)
    {
        $task = Task::where([
            ['done_task' , '=', 1],
            ['user_id' , $request->user_id]
        ])->get();
        return response()->json($task);
    }

    public function showEmployeeWaitTask(Request $request)
    {
        $task = Task::where([
            ['wait_task' , '=', 1],
            ['employee_id' , $request->employee_id]
        ])->get();
        return response()->json($task);
    }

    public function showEmployeeAgreeTask(Request $request)
    {
        $task = Task::where([
            ['agree_task' , '=', 1],
            ['employee_id' , $request->employee_id]
        ])->get();
        return response()->json($task);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeToAgreeTask(Request $request, $id)
    {

        $task = Task::find($id);

        $task->agree_task = 1;
        $task->wait_task = 0;
        $task->save();
       
    }

    public function changeToUnagreeTask(Request $request, $id)
    {
        $request->validate([
            "unagree_descrition" => "required|string|min:10"
        ]);

        $task = Task::find($id);
        $task->unagree_descrition = $request->unagree_descrition;
        $task->unagree_task = 1;
        $task->wait_task = 0;
        $task->save();
    }

    public function changeToDoneTask(Request $request, $id)
    {
        $task = Task::find($id);

        $task->done_task = 1;
        $task->agree_task = 0;
        $task->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
