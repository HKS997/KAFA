<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;

class ManageResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all data from the 'results' table
        $results = Result::all();

        // Pass the data to the view
        return view('ManageStudentResult.Parents.searchStudent', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'studentIC' => 'required|exists:students,studentIC',
            'subject' => 'required|exists:subjects,id',
            'mark' => 'required|numeric',
            'grade' => 'required|string|max:2',
        ]);

        // Find the student by studentIC
        $student = Student::where('studentIC', $request->studentIC)->firstOrFail();

        // Find the subject by subject ID
        $subject = Subject::findOrFail($request->subject);

        // Create a new result record
        $result = new Result();
        $result->studentIC = $request->studentIC;
        $result->subject_id = $request->subject; // Use $request->subject here
        $result->resultMark = $request->mark;
        $result->grade = $request->grade;
        $result->save();

        // Redirect back with a success message
        return redirect()->route('students.search')->with('success', 'Result added successfully!');
    }


    //ManageStudentResult.Teacher.addResult
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($studentIC)
    {
        // Find the student by studentIC
        $student = Student::where('studentIC', $studentIC)->firstOrFail();

        // Find the result associated with the student
        $result = Result::where('studentIC', $studentIC)->first();

        // If result is not found, throw a 404 error
        if (!$result) {
            abort(404, 'Result not found');
        }

        // Get all subjects
        $subjects = Subject::all();

        // Pass the result, student, and subjects to the view
        return view('ManageStudentResult.Teacher.editResult', compact('result', 'student', 'subjects'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required|exists:subjects,id',
            'mark' => 'required|numeric',
            'grade' => 'required|string|max:2',
        ]);

        // Find the result by its ID
        $result = Result::findOrFail($id);

        // Find the subject by its ID
        $subject = Subject::findOrFail($request->subject);

        // Update the result attributes
        $result->update([
            'subjectName' => $subject->subjectName,
            'resultMark' => $request->mark,
            'grade' => $request->grade,
        ]);

        // Redirect back with a success message
        return redirect()->route('students.search')->with('success', 'Result updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function parentSearch()
    {
        return view('ManageStudentResult.Parents.parentSearch');
    }

    public function searchStudentForm()
    {
        return view('ManageStudentResult.Teacher.searchstudent');
    }

    public function searchParent(Request $request)
    {
        $request->validate([
            'studentName' => 'required|string|max:255',
        ]);

        $studentName = $request->input('studentName');
        $students = Student::where('studentName', 'LIKE', "%{$studentName}%")
            ->whereNull('deleted_at') // Exclude soft-deleted records
            ->get();

        return view('ManageStudentResult.Parents.parentSearch', compact('students', 'studentName'));
    }

    public function searchKafa(Request $request)
    {
        $request->validate([
            'studentName' => 'required|string|max:255',
        ]);

        $studentName = $request->input('studentName');
        $students = Student::where('studentName', 'LIKE', "%{$studentName}%")
            ->whereNull('deleted_at') // Exclude soft-deleted records
            ->get();

        return view('ManageStudentResult.KAFA Admin.kafaSearch', compact('students', 'studentName'));
    }

    public function viewKafaResult($studentIC)
    {
        // Retrieve the results for the specified student_id
        $results = Result::where('studentIC', $studentIC)->with('subject')->get();
        $subjects = Subject::all();

        // Pass the results to the view
        return view('ManageStudentResult.KAFA Admin.kafaView', compact('results', 'subjects'));
    }

    public function showMuipSearchForm()
    {
        return view('ManageStudentResult.MUIP Admin.muipSearch');
    }

    public function showKafaSearchForm()
    {
        return view('ManageStudentResult.KAFA Admin.kafaSearch');
    }


    public function searchMuip(Request $request)
    {
        $request->validate([
            'studentName' => 'required|string|max:255',
        ]);

        $studentName = $request->input('studentName');
        $students = Student::where('studentName', 'LIKE', "%{$studentName}%")
            ->whereNull('deleted_at') // Exclude soft-deleted records
            ->get();

        return view('ManageStudentResult.MUIP Admin.muipSearch', compact('students', 'studentName'));
    }

    public function viewMuipResult($studentIC)
    {
        // Retrieve the results for the specified student_id
        $results = Result::where('studentIC', $studentIC)->get();

        // Pass the results to the view
        return view('ManageStudentResult.MUIP Admin.muipView', compact('results'));
    }


    public function searchStudent(Request $request)
    {
        $request->validate([
            'studentName' => 'required|string|max:255',
        ]);

        $studentName = $request->input('studentName');
        $students = Student::where('studentName', 'LIKE', "%{$studentName}%")
            ->whereNull('deleted_at') // Exclude soft-deleted records
            ->get();

        return view('ManageStudentResult.Teacher.searchstudent', compact('students', 'studentName'));
    }

    public function addResult($studentIC)
    {
        // Add leading zeros to the studentIC if necessary
        $StudentIC = str_pad($studentIC, 10, '0', STR_PAD_LEFT);

        // Fetch the student by studentIC
        $student = Student::where('studentIC', $StudentIC)->first();

        // Check if student exists
        if ($student === null) {
            // Handle case where student is not found
            abort(404); // or any other appropriate action
        }

        // Fetch all subjects
        $subjects = Subject::all();

        // Pass the student and subjects to the view
        return view('ManageStudentResult.Teacher.addResult', compact('student', 'subjects'));
    }




    public function viewResult($studentIC)
    {
        // Retrieve the results for the specified student_id
        $results = Result::where('studentIC', $studentIC)->get();

        // Pass the results to the view
        return view('ManageStudentResult.Teacher.viewResult', compact('results'));
    }

    public function viewParent($studentIC)
    {
        // Retrieve the results for the specified student_id
        $results = Result::where('studentIC', $studentIC)->get();

        // Pass the results to the view
        return view('ManageStudentResult.Parents.parentView', compact('results'));
    }


    public function deleteResult($studentIC, $result_id)
    {
        // Find the result by ID
        $result = Result::findOrFail($result_id);

        // Delete the result
        $result->delete();

        // Find the student by ID
        $student = Student::findOrFail($studentIC);

        // Fetch results associated with the student
        $results = Result::where('studentIC', $studentIC)->get();

        // Return the deleteResult blade view with the result data
        return view('ManageStudentResult.Teacher.deleteResult', compact('student', 'results'));
    }


    public function showDeleteForm($studentIC)
    {
        // Find the student by ID
        $student = Student::findOrFail($studentIC);

        // Fetch results associated with the student
        $results = Result::where('studentIC', $studentIC)->get();

        // Return the deleteResult blade view with the result data
        return view('ManageStudentResult.Teacher.deleteResult', compact('student', 'results'));
    }

    public function deleteResultKafa($studentIC, $result_id)
    {
        // Find the result by ID
        $result = Result::findOrFail($result_id);

        // Delete the result
        $result->delete();

        // Find the student by ID
        $student = Student::findOrFail($studentIC);

        // Fetch results associated with the student
        $results = Result::where('studentIC', $studentIC)->get();

        // Return the deleteResult blade view with the result data
        return view('ManageStudentResult.KAFA Admin.kafaSearch', compact('student', 'results'));
    }


    public function showkafaDeleteForm($studentIC)
    {
        // Find the student by ID
        $student = Student::findOrFail($studentIC);

        // Fetch results associated with the student
        $results = Result::where('studentIC', $studentIC)->get();

        // Return the deleteResult blade view with the result data
        return view('ManageStudentResult.KAFA Admin.kafaDelete', compact('student', 'results'));
    }
}
