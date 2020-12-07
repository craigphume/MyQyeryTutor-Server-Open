<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\School;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class TeacherController extends Controller
{
    public function invite(Request $request, $schoolId){
        $rules = [
            'name' => 'required|min:3|max:200',
            'email' => 'required|email|unique:users,email|max:200'
        ];

        $data = $request->validate($rules);

        $school = School::findOrFail($schoolId);

        // TODO put into its own class
        $tmpUser = new User($data);
        $tmpUser->password = bcrypt(uniqid('nopassword', true));
        $tmpUser->school()->associate($school->id)->save();

        $tmpUser->sendWelcomeEmail();

        return redirect(route('admin.school.show', $school->id))
            ->with(['success' => 'Teacher Invited']);
    }

    public function reinvite($id) {
        $teacher = User::findOrFail($id);
        $teacher->sendWelcomeEmail();

        return redirect()->back()->with('success', 'Email sent to ' . $teacher->name);
    }

    public function showInvite($schoolId) {
        $school = School::findOrFail($schoolId);

        return view('admin.teacher.invite', compact('school'));
    }

    public function toggleDisable($id) {
        $teacher = User::findOrFail($id);

        $disabled = true;

        if(is_null($teacher->disabled))
        {
            $teacher->disabled = Carbon::now();
        }
        else
        {
            $teacher->disabled = null;
            $disabled = false;
        }

        $teacher->save();

        return back()
            ->with('success', 'Teacher '. $teacher->name . ' has been ' . ($disabled ? 'Disabled' : 'Enabled') );
    }

    public function show($id) {
        $teacher = User::findOrFail($id);

        return view('admin.teacher.show',
            compact('teacher'));
    }

    public function update(Request $request, $id) {
        $rules = [
            'name' => 'string|min:3|max:200',
            'email' => 'email|max:200',
            'timezone' => 'string'
        ];

        $data = $request->validate($rules);

        $user = User::findOrFail($id);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->timezone = $data['timezone'];

        $user->save();

        return redirect(route('admin.teacher.show', $id))
            ->with('success', 'Profile updated');

//        return 'UPDATE';
    }

    public function resetPasswordLink($id) {
        $user = User::findOrFail($id);
        $token = Password::getRepository()->create($user);

        $user->sendPasswordResetNotification($token);

        return redirect(route('admin.teacher.show', $id))
            ->with('success', 'Email password reset sent');
    }

    public function delete($id) {
        User::destroy($id);

        return redirect()
            ->back()
            ->with('success', 'Teacher deleted successfully');
    }
}
