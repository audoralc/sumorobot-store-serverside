<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Response;

class RoleController extends Controller
{
  public function indexRoles()
  {
    $roles = Role::all();

    return Response::json($roles);
  }


  public function storeRole(Request $request)
  {
    $role = new Role;
    $role->name =
    $request->input('name');

    $role->save;
  }

  public function updateRole()
  {
    $role = new Role;
    $role->name =
    $request->input('name');

    $role->save();

    return Response::json(['success' => 'Role Updated']);

  }

  public function showRole($id)
  {
    $role = Role::find($id);

    return Response::json($role);
  }

  public function deleteRole($id)
  {
    $role = Role::find($id);
    $role->delete();

    return Response::json(['success' => 'Role Deleted.'])
  }
}
