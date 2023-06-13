<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles;
use Validator,Exception;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Roles::whereNot('id', 1)->get();
        return view('backend.roles.index', compact('roles'));
    }

    public function edit($id)
    {
        $role = Roles::find($id);
        return view('backend.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $valid = $validator->validated();

            $user = Roles::find($id);
            $user->name = $valid['name'];
            $user->update();

            return redirect()->route('admin.user.index')->with('success', 'Role successfully update');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }
}
