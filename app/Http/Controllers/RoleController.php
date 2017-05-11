<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Response;
use App\Role;
use Illuminate\Support\Facades\Validator;
use Purifier;

class RoleController extends Controller
{
  public function indexRoles()
  {
    $user=Auth::user();
    if ($user->roleId != 1)
    {
      return Response::json(['error' => "not allowed"])
    };

    $roles = Role::all();

    return Response::json($roles);
  }


  public function storeRole(Request $request)
  {
    $user=Auth::user();
    if ($user->roleId != 1)
    {
      return Response::json(['error' => "not allowed"])
    };

    $rules = [
      'name' => 'required',
    ];

    $validator = Validator::make(Purifier::clean ($request->all()), $rules);

    if ($validator->fails()) {
      return Response::json(['error' => 'all fields required']);
    }

    $role = new Role;
    $role->name =
    $request->input('name');

    $role->save();

    return Response::json(['success' => 'Role created.']);
  }

  public function updateRole($id, Request $request)
  {
    $rules = [
      'name' => 'required',
    ];

    $validator = Validator::make(Purifier::clean ($request->all()), $rules);

    $user=Auth::user();
    if ($user->roleId != 1)
    {
      return Response::json(['error' => "not allowed"])
    };

    $role = Role::find($id);
    $role->name =
    $request->input('name');

    $role->save();

    return Response::json(['success' => 'Role Updated']);
  }

  public function showRole($id)
  {
    $user=Auth::user();
    if ($user->roleId != 1)
    {
      return Response::json(['error' => "not allowed"])
    };

    $role = Role::find($id);

    return Response::json($role);
  }

  public function deleteRole($id)
  {
    $user=Auth::user();
    if ($user->roleId != 1)
    {
      return Response::json(['error' => "not allowed"])
    };

    $role = Role::find($id);
    $role->delete();

    return Response::json(['success' => 'Role Deleted.']);
  }
}
