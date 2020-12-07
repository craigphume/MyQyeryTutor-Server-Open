<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\School;
use App\User;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function update(Request $request) {
// Renewal Subscription JSON
//{
//  "subscription": {
//    "startdate": "2020-01-18",
//    "enddate": "2021-01-18",
//    "number": "abc123",
//    "school_id": "spsc1"
//  }
//}
        // validate the updated subscription
//        $rules = [
//            'subscription' => 'required',
//            'subscription.startdate' => 'required|date',
//            'subscription.enddate' => 'required|date',
//            'subscription.number' => 'required|string',
//            'subscription.school_id' => 'required'
//        ];

        // renewal will just need the school id and new subscription dates

        // update a current subscription
        dd('put');
    }

    public function store(Request $request) {
        // new subscription

        // check json is valid
        if(!$request->json()->all())
        {
            return response()->json('Bad JSON',400);
        }

        // validate the new subscription
        $validator = Validator::make($request->json()->all(), $this->newSubRules());

        if ($validator->fails())
        {
            return response()->json($validator->errors(),401);
        }

        // Create new school model
        $school = new School($request->json('school'));
        $school->save();

        // Create new subscription model
        $subscription = new Subscription($request->json('subscription'));
        $subscription->school()->associate($school)->save(); // associate the school_id with the subscription

        // for each new teacher
        foreach ($request->json('school.teachers') as $user) {

            // TODO put into its own class
            $tmpUser = new User($user);
            $tmpUser->password = bcrypt(uniqid('nopassword', true));
            $tmpUser->school()->associate($school)->save();

            $tmpUser->sendWelcomeEmail();
        }


// New Subscription JSON
//{
//  "subscription": {
//    "startdate": "2020-01-18",
//    "enddate": "2021-01-18",
//    "number": "abc123"
//  },
//  "school": {
//    "name": "Southport State High School",
//    "contact": "Steven Tucker",
//    "email": "email@school.com",
//    "address": "1 Some Street, Southport 4215, Gold Coast",
//    "phone": "0755529555",
//      "teachers": [
//      {
//        "name": "John Doe",
//        "email": "j.doe@email.com"
//      },
//      {
//        "name": "Jane Someone",
//        "email": "jane.someone@email.com"
//      }
//    ]
//  },

//}
        return response()->json('success');
    }

    public function renewSubRules() {

        return [
            'subscription' => 'required',
            'subscription.startdate' => 'required|date',
            'subscription.enddate' => 'required|date',
            'subscription.number' => 'required|string',
            'subscription.school_id' => 'required'
        ];
    }


    /**
     * @return array
     */
    public function newSubRules() {

        return [
            'subscription' => 'bail|required',
            'subscription.startdate' => 'required|date',
            'subscription.enddate' => 'required|date',
            'subscription.number' => 'required|string',
            'school' => 'required',
            'school.name' => 'required|unique:schools,name',
            'school.contact' => 'required|string',
            'school.email' => 'required|email',
            'school.address' => 'required|string',
            'school.phone' => 'required',
            'school.teachers.*.name' => 'required|string',
            'school.teachers.*.email' => 'required|email',
        ];
    }
}
