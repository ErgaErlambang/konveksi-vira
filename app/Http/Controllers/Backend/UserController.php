<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use Validator,Exception;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereNot('id', 1)->get();
        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Roles::whereNot('id', 1)->get();
        return view('backend.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required|unique:users|email",
                "role" => "required",
                "password" => "required"
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $valid = $validator->validated();

            $user = new User;
            $user->name = $valid['name'];
            $user->email = $valid['email'];
            $user->role_id = $valid['role'];
            $user->password = Hash::make($valid['password']);
            $user->save();

            return redirect()->route('admin.user.index')->with('success', 'User successfully created');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $roles = Roles::whereNot('id', 1)->get();
        $user = User::find($id);
        return view('backend.user.edit', compact('roles','user'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required|email",
                "role" => "required",
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $valid = $validator->validated();

            $user = User::find($id);
            $user->name = $valid['name'];
            $user->email = $valid['email'];
            $user->role_id = $valid['role'];
            if($request->password !== null) {
                $user->password = Hash::make($request->password);
            }
            $user->update();

            return redirect()->route('admin.user.index')->with('success', 'User successfully update');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            User::find($id)->delete();
            return redirect()->back()->with('success', 'User successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
