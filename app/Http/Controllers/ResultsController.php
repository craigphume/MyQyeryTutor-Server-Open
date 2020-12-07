<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Result;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class ResultsController extends Controller
{
    public function store(Request $request) {

        //TODO check the response is empty or doesnt have the keys

        // Validate the json structure
        if($this->validateJson($request))
        {
            return response()->json(['error' => 'No or malformed JSON'], 400);
        }

        // get the classroom from classcode
        $classroom = Classroom::where('code', $request->get('classcode'))->first();

        // Fetch or Create a student using the data
        $student = Student::firstOrCreate(
            ['email' => $request->json('student.email'),
                'classroom_id' => $classroom->id
            ],
            ['firstname' => $request->json('student.firstname'),
                'lastname' => $request->json('student.lastname'),
            ]
        );

        // get the timestamp from the request
        $timestamp = null;

        if($request->json()->has('timestamp') && !empty($request->json('timestamp')))
        {
            $timestamp = Carbon::createFromTimeString($request->json('timestamp'));
        }

        // get all data for the student after this timestamp
        $resultsToSend = Result::where('student_id', $student->id)
            ->where('classroom_id', $classroom->id)
            ->when($timestamp, function ($query) use ($timestamp){
                return $query->where('updated_at', '>=', $timestamp);
            })->get();

        // save new results if any
        $results = $request->json('results');

        // iterate over the list of topics and iterate over the list of questions
        if(is_array($results)) {
            $keys = ['topic', 'question','pass','query', 'attempts' ];
            foreach ($results as $result) {

                // check thet keys exist
                if(Arr::has($result, $keys)) {
                    Result::updateOrCreate(
                        ['student_id' => $student->id,
                            'topic' => $result['topic'],
                            'question' => $result['question']
                        ],
                        ['pass' => $result['pass'],
                            'query' => $result['query'],
                            'attempts' => $result['attempts'],
                            'ip' => request()->ip(),
                            'classroom_id' => $classroom->id,
                        ]
                    );
                }
            }
        }
        // return old results and timestamp
        $now = Carbon::now()->toDateTimeString();

        $collection = collect([
            'timestamp' => $now,
            'results' => $resultsToSend
        ]);

        return response()->json($collection, 200);
    }

    public function validateJson(Request $request)
    {
        $rules = [
            'student' => 'required|bail',
            'student.email' => 'required|email|max:200',
            'student.firstname' => 'required|string|min:2|max:200',
            'student.lastname' => 'required:string|min:2|max:200',
            'timestamp' => 'nullable|date',
        ];

        $validator = Validator::make($request->json()->all(), $rules);

        return ($validator->fails());
    }

}
