<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\School;
use App\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function create($id) {
        $school = School::findOrFail($id);

        return view('admin.subscription.create', compact('school'));
    }

    public function save(Request $request, $id) {
        // TODO retire old subs or combine the dates
        $data = $request->validate($this->subscriptionRules());

        $school = School::findOrFail($id);

        $newInvoice = new Subscription($data['subscription']);
        $newInvoice->number = uniqid();
        $newInvoice->school()->associate($school)->save();

        return redirect(route('admin.school.show', $id))
            ->with('success', 'New subscription created');
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
