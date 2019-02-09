<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function login(Request $request){
//        dd($request->all());
//        echo $request['email'];
//        return response()->json( $request->all(), $this->successStatus);

        if(Auth::attempt(['email' => $request['email'],'password' => $request['password']])){
            $user = Auth::user();

            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['name']=$user->name;
            $success['email']=$user->email;
            $success['id']=$user->id;
            if($user->role ==2 )
            {
                $success['snn']=$user->student->snn;

            }
            return response()->json( $success, 200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
}
