<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Purifier;
use Response;
use App\User;
use Hash;
use JWTAuth;
use File;


class UserController extends Controller
{
  public function storeUser(Request $request) {

    $rules = [
      'name' => 'required';
      'email' => 'required';
      'password' => 'required';
      'roleID' => 'required';
    ]

    $validator = Validator::make(Purifier::clean($request->all()), $rules);

    if ($validator->fails()) {
      return Response::json(['error' => 'all fields required']);
    }

    else {
      check=User::where('email', '=', $request->input('email')) ->orWhere('name', '=', $request->input('name'))->first();

      if (!empty($check)){
        return Response::json(['error' => 'user already exists']);
      }

      $user= new User;
      $user->name =
      $request->input('name');
      $user->email =
      $request->input('email');
      $user->password =
      Hash::make($request->input('password'));

      $user->save();

      return Response::json(['success' => 'user registered']);
    }
  }

  public function signIn(Request $request)
  {
    $rules = [
      'email' => 'required',
      'password' => 'required'
    ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);

    if ($validator->fails()) {
      return Response::json(['error' => "all fields required"]);
    }

    $email= $request->input('email');
    $password= $request->input('password');
    $cred= compact('email', 'password', ['email', 'password']);

    $token= JWAuth::attempt($cred);
    return Response:: json(compact('token'));
  }

  public function index()
  {
    return File::get('index.html');
  }
}
