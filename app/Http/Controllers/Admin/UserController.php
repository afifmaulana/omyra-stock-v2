<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('ui.admin.user.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('ui.admin.user.create', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $role = Role::where('id', $request->role)->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($role->name);
        return redirect()->route('admin.user.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
    }
}
