<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Middleware\ChangeLanguage;
use App\User;
use JWTAuth;
use Auth;
use JWTFactory;
use Validator;
use Response;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class AuthController extends Controller
{


    // Register New User
    public function register(UserRequest $request){

        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        if($request->hasFile('image')) {    
            $imgName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $imgName);
            $user->image = 'img/'.$imgName;
        }
        $user->save();
        $token=JWTAuth::fromUser($user);
        return Response::json(['token'=>$token,'user'=>$user]);

    }


    //Login

    public function login(Request $request){

        $credentials = $request->only('email','password');
      
          try{
           
                if(! $token=JWTAuth::attempt($credentials)){
                    return response()->json(['error'=>'invalide email or password'],[401]);
                }
            }catch(JWTException $e){
                return response()->json(['error'=>'could not create token']);
            }
        return response()->json(['token'=>$token,'user'=>auth()->user()]);
    }

    public function logout()
    {
        // auth()->guard('api')->logout();
        JWTAuth::invalidate(JWTAuth::getToken());


        return response()->json([
            'status' => 'success',
            'message' => 'logout'
        ], 200);
        
    }
    
}
