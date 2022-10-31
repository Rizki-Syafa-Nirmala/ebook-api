<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;


class AuthController extends Controller
{
public function register(Request $request){
    $fields = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|string|unique:users,email',
        'password' => 'required|string|confirmed|min:6'
    ]);

    $user = User::create([
        'name' => $fields['name'],
        'email' => $fields['email'],
        'password' => bcrypt($fields['password'])
    ]);

    $token = $user->createToken('tokenku')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response, 201);
}
public function login(Request $request){
    $fields = $request->validate([
        'email' => 'required|string',
        'password' => 'required|string'
    ]);

    //check email
    $user = User::where('email', $fields['email'])->first();

    //check password
    if (!$user || !Hash::check($fields['password'], $user->password))
    return response([
        'message' => 'unauthorized'
    ], 401);

    $token = $user->createToken('tokenku')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response, 201);
}

public function logout(Request $request){
    $request->user()->currentAccessToken()->delete();

    return[
        'message' => 'Logged Out'
    ];
}
}


//{
//    public function me(){
//        return[
//        'NIS' => 3103120199,
//        'Name' => 'Rizki Syafa Nirmala',
//        'Phone' => '085326831850',
//        'Class' => 'XII RPL 6'
//    ];
//    }
//}