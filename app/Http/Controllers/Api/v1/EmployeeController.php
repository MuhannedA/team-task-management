<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMyAllEmployee(Request $request)
    {
        $user = Employee::where('user_id' , $request->user_id)->get();
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newEmployee(Request $request)
    {
        $request->validate([             
            "name" =>"required|string|min:3",
            "email"=> "required|email|unique:employees,email",
            "password" => "required|string",
            "user_id" => "required"
        ]);
        $user = Employee::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "user_id" => $request->user_id,
        ]);
        return response()->json($user);
    }

    public function employeeLogin(Request $request){
        $user = Employee::where('email' , $request->email)->first();
        if($user){
            if(Hash::check($request->password , $user->password)){
                return response()->json($user);
            }
        }
        return "wrong password";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteEmployee($id)
    {
        $user = Employee::find($id);
       $do= $user->delete();
        if($do){
             return 'has been removed user';
        }
    }
}
