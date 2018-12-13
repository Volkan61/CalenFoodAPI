<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;

class RoleController extends Controller
{
    public function postRole(Request $request)
    {
        $role = new Role();
        $role->role = $request->input('role');
        $role->save();


        return response()->json([
            'role' => $role
        ], 201);
    }





    public function postRelation(Request $request)
    {
        $user = new User();
        $user->email = 'volkanhmo@wwedffdfdsasadsdffwasds.de';
        $user->password = 'asdsadasdadffdfsdsa';
        $user->save();

        $roles = Role::find(1);
        $user->role()->save($roles);

        return response()->json([
            'role' => $user
        ], 201);
    }








}
