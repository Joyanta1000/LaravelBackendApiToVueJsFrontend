<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Exception;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Register(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:1|max:255',
            'email' => 'required|string|min:1|max:255|unique:users,email',
            
            'password' => 'min:6|required_with:password_confirmation|same:confirm_password',
            'confirm_password' => 'min:6'
            // 'city_name' => 'required|string|min:3|max:255',
            // 'email' => 'required|string|email|max:255'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);
}
else{
            try {

                $user = new User();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = Hash::make($request->password);
            $user->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Registration Succeded',
                    'user' => $user
                ]);

            } catch (Exception $e) {
                return response()->json([
                    'message' => $e->getMessage()
                ]);
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Login(Request $request)
    {
        $loginData = $request->validate([
            
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!Auth()->attempt($loginData))
        {
            return response(['message'=>'Invalid credentials']);
        }

        $accessToken = Auth()->user()->createToken('authToken')->accessToken;
        return response(['user'=> Auth()->user(), 'accessToken'=> $accessToken, 'isLoggedIn' => 1]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Logout(Request $request)
{
    // $user = Auth::guard('api')->user();

    // if ($user) {
    //     $user->api_token = null;
    //     $user->save();
    // }
    Auth::logout();
     // log the user out of our application
     Session::flush();

    return response()->json(['data' => 'User logged out.'], 200);
}
}
