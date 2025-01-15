<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\PostMortem;
use App\Models\Student;
use App\Models\Result;
use App\Models\Subject;
use Carbon\Carbon;

class ManageReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * This method retrieves all activities with their associated post-mortems
     * and returns the view for the KAFA Admin to see the list of activities.
     */
    public function index()
    {
        $activities = Activity::with('postMortems')->get();

        return view('ManageReportActivity.KAFA Admin.ViewActivityList', compact('activities'));
    }

    /**
     * Display a listing of the resource for MUIP Admin.
     *
     * This method retrieves all activities with their associated post-mortems
     * and returns the view for the MUIP Admin to see the list of finished activities.
     */
    public function indexMuip()
    {
        $activities = Activity::with('postMortems')->get();

        return view('ManageReportActivity.MUIP Admin.ViewFinishActivityList', compact('activities'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * This method finds a specific activity by its ID and returns the form view
     * for the KAFA Admin to add a new post-mortem.
     */    public function create($id)
    {
        //
        $activity = Activity::findOrFail($id);
        return view('ManageReportActivity.KAFA Admin.AddPostMortemForm', ['activity' => $activity]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * This method validates the form data, creates a new post-mortem for the specified activity,
     * and saves it to the database. It then redirects to the complete post-mortem view with a success message.
     */
    public function store(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'postDescription' => 'required|string',
        ]);

        $activity = Activity::findOrFail($id);

        // Create a new post-mortem instance
        $postMortem = new PostMortem();
        $postMortem->postDescription = $validatedData['postDescription'];
        $postMortem->postDate = Carbon::now(); // Set the current time as the post date
        $postMortem->postStatus = 'Finished'; // Set the status to Finished

        // Assign the activity to the post-mortem
        $postMortem->activity()->associate($activity);
        $postMortem->save();

        // Redirect back to the activity page or any other page as needed
        return redirect()->route('report.ViewCompletePostMortem', $activity->id)->with('success', 'Post-Mortem created successfully');
    }





    /**
     * Display the specified resource.
     *
     * This method finds a specific activity by its ID and returns the detail view
     * for the KAFA Admin to see the activity details.
     */
    public function show(string $id)
    {
        $activity = Activity::findOrFail($id);
        return view('ManageReportActivity.KAFA Admin.ViewActivityDetail', ['activity' => $activity]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * This method finds a specific activity by its ID and checks if it has a finished post-mortem.
     * If so, it returns the form view for editing the post-mortem. Otherwise, it redirects back with an error message.
     */
    public function edit($id)
    {
        $activity = Activity::findOrFail($id);

        // Check if the activity has a finished status
        if ($activity->postMortems()->exists()) {
            $postMortem = $activity->postMortems()->latest()->first();
            if ($postMortem->postStatus == 'Finished') {
                // Allow editing the activity
                return view('ManageReportActivity.KAFA Admin.EditPostMortemForm', compact('activity', 'postMortem'));
            }
        }

        // Redirect back with a message if editing is not allowed
        return redirect()->route('report.ViewActivityDetail', $activity->id)->with('error', 'Editing not allowed for activities with ongoing status.');
    }




    /**
     * Update the specified resource in storage.
     *
     * This method validates the form data and updates the specified post-mortem in the database.
     * It then redirects to the complete post-mortem view with a success message.
     */
    public function update(Request $request, $id, $postMortemId)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'postDescription' => 'required|string',
        ]);

        // Find the post-mortem
        $postMortem = PostMortem::findOrFail($postMortemId);
        $postMortem->postDescription = $validatedData['postDescription'];
        $postMortem->save();

        // Redirect back to the post-mortem view page with success message
        return redirect()->route('report.ViewCompletePostMortem', $id)->with('success', 'Post-Mortem updated successfully');
    }



    /**
     * Display the complete post-mortem for a specific activity.
     *
     * This method finds a specific activity by its ID along with its post-mortems
     * and returns the view for the KAFA Admin to see the complete post-mortem.
     */
    public function showPostMortem($id)
    {
        $activity = Activity::with('postMortems')->findOrFail($id);

        return view('ManageReportActivity.KAFA Admin.ViewCompletePostMortem', compact('activity'));
    }

    /**
     * Display the complete post-mortem for a specific activity for MUIP Admin.
     *
     * This method finds a specific activity by its ID along with its post-mortems
     * and returns the view for the MUIP Admin to see the complete post-mortem.
     */
    public function showPostMortemMuip($id)
    {
        $activity = Activity::with('postMortems')->findOrFail($id);

        return view('ManageReportActivity.MUIP Admin.ViewCompletePostMortem', compact('activity'));
    }

    /**
     * Display the years of students.
     *
     * This method retrieves distinct student years and returns the view for the MUIP Admin
     * to select an academic year.
     */
    public function showYears()
    {

        $years = Student::select('studentYear')->distinct()->orderBy('studentYear')->pluck('studentYear');

        return view('ManageReportActivity.MUIP Admin.ViewAcademicLevelOption', compact('years'));
    }

    /**
     * Display the list of students for a specific year.
     *
     * This method retrieves students by their academic year and returns the view
     * for the MUIP Admin to see the list of students for that year.
     */
    public function showStudentsByYear($year)
    {
        $students = Student::where('studentYear', $year)->get();
        return view('ManageReportActivity.MUIP Admin.ViewStudentList', ['students' => $students, 'year' => $year]);
    }



    /**
     * Display the academic performance of a specific student.
     *
     * This method retrieves the results for a specific student and returns the view
     * for the MUIP Admin to see the academic performance of that student.
     */
    public function viewAcademicPerformance($studentIC)
    {
        // Assuming you want to get results for a specific student
        $results = Result::where('studentIC', $studentIC)->with('subject')->get();
        $subjects = Subject::all(); // Retrieve all subjects

        return view('ManageReportActivity.MUIP Admin.ViewAcademicPerformance', compact('results', 'subjects'));
    }
}
