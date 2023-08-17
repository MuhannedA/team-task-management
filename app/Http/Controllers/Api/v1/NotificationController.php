<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\EmployeeToken;
use App\Models\UserToken;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function tokenSigninUser(Request $request){
       $request->validate([
        "user_token" => "string" 
       ]);

        $token = UserToken::create([
            'user_token' => $request->user_token,
            'user_id' => $request->user_id
        ]);

        return response()->json($token);
    }



    public function tokenSigninEmployee(Request $request){
        $request->validate([
         "employee_token" => "string" 
        ]);
 
         $token = EmployeeToken::create([
             'employee_token' => $request->employee_token,
             'employee_id' => $request->employee_id
         ]);

         return response()->json($token);
     }



     public function updateUserToken(Request $request , $id)
    {
        $get_user = UserToken::where('user_id' , $id)->first();
        

        $get_user->user_token =  $request->user_token;
        $get_user->save();

        return response()->json($get_user);
       
    }



    public function updateEmployeeToken(Request $request, $id)
    {

        $token = EmployeeToken::where('employee_id' , $id)->first();

        $token->employee_token = $request->employee_token;
        $token->save();

        return response()->json($token);
       
    }


    public function getEmpolyeeToken( $id)
    {

        $token = EmployeeToken::where('employee_id' , $id)->get();


        return response()->json($token);
       
    }


    public function getUserToken( $id)
    {

        $token = UserToken::where('user_id' , $id)->get();


        return response()->json($token);
       
    }


    public function sendNewTaskNotification(Request $request){

        $SERVER_API_KEY = 'AAAAArwsiPg:APA91bHXUHcYDEZDSme7xi8yURpgdGYDx3h39PSh6cFtJ4oMDgj2MiDTLtoiZa-gICddw7jwAL_wgzNtTynYMP2YOjMR1IytA1NZeK9L2xznwe3OVQKZtZiN2RQiKB_0Aj9BdmU6QN4f';

        $token_1 = $request->fcm_token;

        $data = [
            "registration_ids" => [
                $token_1
            ],

            "notifications" => [
                "title" => $request->title,
                "body" => $request->body,
                "sound" => true
            ]
            ];

            $dataString = json_encode($data);

            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json'
            ];  

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
            curl_setopt($ch, CURLOPT_PORT, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            $response = curl_exec($ch);
                return response()->json($response);
            }
}
