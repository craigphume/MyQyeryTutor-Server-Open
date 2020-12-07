<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index() {
        return view('admin.profile.index');
    }


    public function update(Request $request) {
        $rules = [
            'name' => 'required|string|min:3|max:200',
            'email' => 'required|email|max:200',
            'password' => 'nullable|confirmed|min:8|max:200',
            'current_password' => 'nullable|password:admin|required_with:password'

        ];

        $data = $request->validate($rules);

        $user = Auth::guard('admin')->user();

        $user->name = $data['name'];
        $user->email = $data['email'];
        if($data['password'])
        {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        return redirect(route('admin.profile'))
            ->with('success', 'Profile updated');
    }
}
