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

    /**
     * Register a new user.
     *
     * @param  Obj $request with email, forename, surname and password.
     * @return json string.
     */

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

     /**
     * Login a user.
     *
     * @param  Obj $request with email and password.
     * @return json string with user token.
     */

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

    /**
     * Get user's data.
     *
     * @param  Obj $request with user's token.
     * @return json with user data or and error.
     */

    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);
        if($user) {
            return response()->json(['result' => $user]);
        }

        return response()->json(['error'=> 'User doesn not exist"'], 404);
    }

    /**
     * Delete a user.
     *
     * @param  Obj $user.
     * @return json success message or an error.
     */

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

    /**
     * Update a user.
     *
     * @param  Obj $user.
     * @param  Obj $request with user's data.
     * @return json success message or an error.
     */

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