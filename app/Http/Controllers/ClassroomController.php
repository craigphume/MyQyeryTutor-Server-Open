<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Question;
use App\Result;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{

    // GET::index = show all classrooms
    // GET::show/{id}

    // GET::create = show create new classroom form
    // POST:create = save the new classroom

    // GET::edit/{id} = edit existing classroom form same as create form
    // POST::edit/{id} = save


    // Show all Classrooms
    public function index()
    {
        //get classrooms paginated
        $classrooms = Classroom::where('school_id', Auth::user()->school_id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('teacher.classroom.index', compact('classrooms'));
    }

    // Show an individual Classroom with the id
    public function show($id)
    {
        $classroom = Classroom::findOrFail($id);
        $students = Student::where('classroom_id', $classroom->id)->paginate(10);
        $questions = Question::with('topic:id,name')->get(['title', 'topic_id']);
        $questionResults = $this->questionResults($id);
        $studentsResults = $this->studentResults($id);

        return view('teacher.classroom.show',
            compact(
                'classroom',
                'students',
                'questions',
                'questionResults',
                'studentsResults'
            )
        );

        // for each question from the class_id
        // get the pass, fail and incomplete
    }

    // Show the Create Classroom form
    public function create()
    {
        return view('teacher.classroom.create',[
            'title' => 'Create new classroom',
            'postRoute' => 'classroom.store',
            'id' => '',
        ]);
    }

    // Save the Create Classroom form
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'name' => $this->nameRules(),
        ]);

        $code = $this->makeJoinCode();

        $classroom = new Classroom([
            'name' => $request->name,
            'code' => $code,
            'school_id' => Auth::user()->school_id,
            'user_id' => Auth::user()->id,
        ]);

        $classroom->save();

        return redirect(route('classroom.show', $classroom->id))
            ->with('success', 'Class "' .  $request->get('name') . '" saved');
    }

    // Show the Edit Classroom form <= same as the Crate Classroom form, but populated.
    public function edit($id)
    {

        $classroom = Classroom::findOrFail($id);

        return view('teacher.classroom.create',[
            'title' => 'Edit Classroom',
            'postRoute' => 'classroom.update',
            'id' => $id,
            'classroom' => $classroom,
        ]);
    }

    // Update a Edit Classroom form
    public function update(Request $request, $id)
    {

        // Validate
        $request->validate([
            'name' => $this->nameRules(),
        ]);

        $classroom = Classroom::findOrFail($id);
        $classroom->name = $request->input('name');

        if($request->has('codecheck'))
        {
            $classroom->code = $this->makeJoinCode();
        }

        $classroom->save();

        return redirect(route('classroom.show', $classroom->id))
            ->with('success', 'Class "' .  $request->get('name') . '" saved');

//        return view('classroom.show', ['classroom' => $classroom]);
    }

    /**
     * Delete an existing Classroom
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        Classroom::destroy($id);

        return redirect()->route('classroom')->with(['success' => 'Classroom deleted']);
    }

    public function studentResults($id) {

        $students = Student::where('classroom_id', $id)->get();
        $results = Result::where('classroom_id', $id)->get();
        $questionCount = Question::all()->count();

        $studResults = collect(['questionCount' => $questionCount]);

        $sinq = collect();

        foreach ($students as $student)
        {
            $key = $student->email;
            $sinq->put($key, [
                'pass' => 0,
                'fail' => 0,
            ]);
        }

        foreach ($results as $result)
        {
            $key = $result->student->email;

            $oldpass = $sinq[$key]['pass'];
            $oldfail = $sinq[$key]['fail'];

            $pass = ($oldpass + (($result->pass) ? 1 : 0));
            $fail = ($oldfail + ((!$result->pass) ? 1 : 0));

            $sinq[$key] = ['pass' => $pass, 'fail' => $fail];
        }

        $studResults->put('students', $sinq);

        return $studResults;
    }

    public function questionResults($id) {

        $studCount = Student::where('classroom_id', $id)->count();
        $questionResults = Result::where('classroom_id', $id)->get();
        $questions = Question::with('topic:id,name')->get(['title', 'topic_id']);

        $results = collect(['studentCount' => $studCount]);

        $qandr = collect();

        // Load all questions into the collection
        foreach ($questions as $question)
        {
            $key = $question->topic->name . ' - ' . $question->title;
            $qandr->put($key, [
                'pass' => 0,
                'fail' => 0
            ]);
        }

        foreach ($questionResults as $questionResult)
        {
            $key = $questionResult->topic . ' - ' . $questionResult->question;

            // check that the key exist before indexing
            if(Arr::exists($qandr, $key))
            {
                $oldpass = $qandr[$key]['pass'];
                $oldfail = $qandr[$key]['fail'];

                $pass = ($oldpass + (($questionResult->pass) ? 1 : 0));
                $fail = ($oldfail + ((!$questionResult->pass) ? 1 : 0));

                $qandr[$key] = ['pass' => $pass, 'fail' => $fail];
            }
        }

        $results->put('questions', $qandr);

        return $results;
    }



    /**
     * returns the validation rule set for creating or modifying a Classroom
     * @return string
     */
    public function nameRules() {
        return 'required|min:3|unique:classrooms,name,NULL,id,school_id,' . Auth::user()->school_id;
    }

    /**
     * Generate a new join code for the school
     * @return string
     */
    function makeJoinCode() {
        // get all classroom codes from one call
        $classroomCodes = Classroom::all()->pluck('code');
        $code = null;

        // Keep making codes until it is unique in the Classroom codes
        do {
            $code = $this->generateCode();
        } while ($classroomCodes->contains($code));

        return $code;
    }

    function generateCode() {
        return strtoupper(rtrim(
            str_replace(
                ['+', '_', '/'],
                chr(rand(65,90)),
                base64_encode(
                    openssl_random_pseudo_bytes(
                        3 * (11 >> 2)
                    )
                )), '='));
    }

}
