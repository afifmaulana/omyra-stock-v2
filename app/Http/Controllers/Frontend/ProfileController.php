<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $roles = Role::all();
        return view('ui.frontend.profile.profile', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required',
        //     'role' => 'required',
        // ]);
        $user = Auth::user()->id;
        $role = Role::where('id', $request->role)->first();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($role->name);

        return redirect()->route('frontend.profile.edit')->with('success', 'Berhasil mengubah data Barang Jadi');
    }
}
