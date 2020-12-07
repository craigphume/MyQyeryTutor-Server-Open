<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementController extends Controller
{
    public function index() {
        // get the teachers for a school
        $teachers = User::where('school_id', Auth::user()->school_id)->get();

        return view('teacher.manage.index', compact('teachers'));
    }

    public function delete($id) {

        $teacher = User::findOrFail($id);

        // Check the teacher belongs to the same school as the teacher being deleted
        if(Auth::user()->school_id != $teacher->school_id){
            abort(401);
        }

        $teacher->delete();

        return redirect()
            ->back()
            ->with('success', 'Teacher deleted successfully');
    }

    public function toggleDisable($id) {
        $teacher = User::where('school_id', Auth::user()->school_id)->where('id', $id)->first();

        if(is_null($teacher->disabled))
        {
            $teacher->disabled = Carbon::now();
        }
        else
        {
            $teacher->disabled = null;
        }

        $teacher->save();

        return back();
    }

    public function invite(Request $request){
        $rules = [
            'name' => 'required|min:3|max:200',
            'email' => 'required|email|unique:users,email|max:200'
        ];

        $data = $request->validate($rules);

        // TODO put into its own class
        $tmpUser = new User($data);
        $tmpUser->password = bcrypt(uniqid('nopassword', true));
        $tmpUser->school()->associate(Auth::user()->school_id)->save();

        $tmpUser->sendWelcomeEmail();

        return redirect(route('manage'))
            ->with(['success' => 'Teacher Invited']);
    }

    public function showInvite() {
        return view('teacher.manage.invite');
    }
}
