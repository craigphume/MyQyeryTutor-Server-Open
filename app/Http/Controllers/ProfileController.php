<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() {
        return view('teacher.profile.index');
    }

    public function update(Request $request) {
        // check is anything is updated validate and save

        $rules = [
            'name' => 'string|min:3|max:200',
            'email' => 'email|max:200',
            'timezone' => 'string'
        ];

        $data = $request->validate($rules);

        $user = Auth::user();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->timezone = $data['timezone'];

        $user->save();

        return redirect(route('profile'))
            ->with('success', 'Profile updated');
    }
}
