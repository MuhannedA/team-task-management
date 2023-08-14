<?php

use App\Http\Controllers\Api\v1\EmployeeController;
use App\Http\Controllers\Api\v1\NotificationController;
use App\Http\Controllers\Api\v1\TaskController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('/v1')->group(function(){

    //users section is here

    Route::post('/new/user' , [UserController::class , 'newUser']);

    Route::post('/login/user' , [UserController::class , 'userLogin']); 

    //employees section is here

    Route::post('/new/employee' , [EmployeeController::class , 'newEmployee']);

    Route::get('/show/employee/{user_id}' , [EmployeeController::class , 'showMyAllEmployee']);

    Route::post('/login/employee' , [EmployeeController::class , 'employeeLogin']);

    Route::delete('/remove/employee/{user_id}' , [EmployeeController::class , 'deleteEmployee']);

    //task section is here 

    Route::get('/show/employee/task/{employee_id}' , [TaskController::class , 'showEmployeeAllTask']);

    Route::get('/show/user/wait/task/{user_id}' , [TaskController::class , 'showMyWaitTask']);

    Route::get('/show/user/agree/task/{user_id}' , [TaskController::class , 'showMyagreeTask']);

    Route::get('/show/user/unagree/task/{user_id}' , [TaskController::class , 'showMyUnagreeTask']);

    Route::get('/show/user/done/task/{user_id}' , [TaskController::class , 'showMyDoneTask']);

    Route::get('/show/employee/wait/task/{employee_id}' , [TaskController::class , 'showEmployeeWaitTask']);

    Route::get('/show/employee/agree/task/{employee_id}' , [TaskController::class , 'showEmployeeAgreeTask']);

    Route::get('/show/user/task/{user_id}' , [TaskController::class , 'showMyAllTask']);

    Route::post('/new/task' , [TaskController::class , 'newTask']);

    Route::patch('/agree/task/{id}' , [TaskController::class , 'changeToAgreeTask']);

    Route::patch('/unagree/task/{id}' , [TaskController::class , 'changeToUnagreeTask']);

    Route::patch('/done/task/{id}' , [TaskController::class , 'changeToDoneTask']);

   //notifiction token suction 
   
   Route::post('/new/user/token', [NotificationController::class , 'tokenSigninUser']);

   Route::post('/new/employee/token', [NotificationController::class , 'tokenSigninEmployee']);

   Route::patch('/user/update/token/{user_id}', [NotificationController::class , 'updateUserToken']);

   Route::patch('/employee/update/token/{employee_id}', [NotificationController::class , 'updateEmployeeToken']);

   Route::post('/send/task/notification', [NotificationController::class , 'sendNewTaskNotification']);


});
