<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use JWTAuthException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use App\Http\Controllers\Auth\RegisterController;

class UserController extends RegisterController
{

    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }



    public function register(Request $request){

        // First check if user already exists
        if(User::where('email' , $request->get('email'))->first()){
            return response()->json(['error'=> 'User already exists'], 401);
        }

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
          //  $this->setStatusCode(422);
            return response()->json([$validator->errors()], 200);
      
        }


        $user = $this->user->create([
            'id' => Uuid::uuid1(),
            'forename' => $request->get('forename'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);
        return response()->json(['status'=>true,'message'=>'User created successfully','data'=>$user], 201);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['invalid_email_or_password'], 422);
            }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);
        if($user) {
            return response()->json(['result' => $user]);
        }

        return response()->json(['error'=> 'User doesn not exist"'], 404);
    }

    public function delete(User $user){

        $authUser = JWTAuth::parseToken()->authenticate();
       
        
        if($authUser->id  != $user->id){
            return response()->json(['error'=> 'The user has not permision"'], 401);

        }

        if($user->delete()){
            return response()->json(['message'=> 'User deleted"'], 200);

        }

         return response()->json(['error'=> 'The user was not deleted"'], 200);
    }

    public function update(User $user, Request $request){

        $authUser = JWTAuth::parseToken()->authenticate();
       
        
        if($authUser->id  != $user->id){
            return response()->json(['error'=> 'The user has not permision"'], 401);


        }

        $user->forename = (!empty($request->get('forename'))) ? $request->get('forename') : $user->forename;
        $user->surname = (!empty($request->get('surname'))) ? $request->get('surname') : $user->surname;
        $user->email = (!empty($request->get('email'))) ? $request->get('email') : $user->email;

        if($user->save()){
            return response()->json(['message'=> 'User updated"'], 200);

        }

         return response()->json(['error'=> 'The user was not deleted"'], 200);
    }
}