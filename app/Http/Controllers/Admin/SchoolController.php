<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\School;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Class SchoolController
 * @package App\Http\Controllers\Admin
 */
class SchoolController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id) {

        $school = School::findOrFail($id);

        return view('admin.school.show', compact('school'));
    }

    /**
     * @param $id
     * @return string
     */
    public function delete($id) {
        return "DELETE";
    }

    public function toggleDisable($id) {
        $school = School::findOrFail($id);

        if(is_null($school->disabled))
        {
            $school->disabled = Carbon::now();
        }
        else
        {
            $school->disabled = null;
        }

        $school->save();

        return back();
    }

    public function create() {
        return view('admin.school.create', [
            'title' => 'Create New School',
            'postRoute' => 'admin.school.store',
            'id' => '',
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate(
            array_merge($this->subscriptionRules(), $this->schoolRules())
        );

        $newSchool = new School($data);
        $newSchool->expiry = $data['subscription']['enddate'];
        $newSchool->save();

        $newInvoice = new Subscription($data['subscription']);
        $newInvoice->number = uniqid();
        $newInvoice->school()->associate($newSchool)->save();

        return redirect()->route('admin.school.show', $newSchool->id)
            ->with('success', 'School Created');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $school = School::findOrFail($id);

        return view('admin.school.create', [
            'title' => 'Edit School',
            'postRoute' => 'admin.school.update',
            'id' => $id,
            'school' => $school
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate($this->schoolRules($id));

        School::findOrFail($id)->update($data);

        return redirect(route('admin.school.show', $id))
            ->with('success', 'School "' . $data['name'] . '" updated');

    }

    /**
     * @return array
     */
    public function schoolRules($id = null)
    {
        $name = ['required', Rule::unique('schools')->ignore($id)];

        if(!$id)
        {
            $name = 'required|unique:schools,name';
        }

        $rules = array_merge([
            'contact' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required',
        ], ['name' => $name]);

        return $rules;
    }

    /**
     * @return array
     */
    public function subscriptionRules()
    {

        return [
            'subscription' => 'bail|required',
            'subscription.startdate' => 'required|date',
            'subscription.enddate' => 'required|date',
        ];
    }
}
