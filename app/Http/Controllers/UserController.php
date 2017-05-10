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
  public function indexUsers()
  {
    $users = User::all();

    return Response::json($users);
  }

  public function storeUser(Request $request) {

    $rules = [
      'name' => 'required',
      'email' => 'required',
      'password' => 'required',
    ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);

    if ($validator->fails()) {
    return Response::json(['error' => 'all fields required']);
    }

    else {
      $check=User::where('email', '=', $request->input('email')) ->orWhere('name', '=', $request->input('name'))->first();

      if (!empty($check)){
        return Response::json(['error' => 'user already exists']);
      }

      $user= new User;
      $user->name =
      $request->input('name');
      $user->email =
      $request->input('email');
      $user->roleId = 2;
      $user->password =
      Hash::make($request->input('password'));


      $user->save();

      return Response::json(['success' => 'user registered']);
    }
  }
  public function updateUser($id, Request $request)
  {
  $rules = [
    'name' => 'required',
    'email' => 'required',
    'password' => 'required',
  ];

  $validator = Validator::make(Purifier::clean($request->all()), $rules);

  if ($validator->fails()) {
    return Response::json(['error' => 'all fields required']);
  }

  else {
    $check=User::where('email', '=', $request->input('email')) ->orWhere('name', '=', $request->input('name'))->first();

    if (!empty($check)){
      return Response::json(['error' => 'update failed']);
    }
    $user = User::find($id);

    $user->email = $request->input('email');
    $user->name = $request->input('name');
    $user->password = $request->input('password');

    $user->save();

    return Response::json(['success' => 'User Updated.']);
  }

}


  public function showUser($id)
  {
    $user = User::find($id);

    return Response::json($user);
  }

  public function deleteUser($id)
  {
    $user = User::find($id);

    $user->delete();

    return Response::json(['success' => "User deleted."]);
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

    $token= JWTAuth::attempt($cred);
    return Response::json(compact('token'));
  }


}
