<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Timetable;
use App\Models\TimetableRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManageTimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the authenticated user and their role
        $user = Auth::user();
        $role = $user->role;

        // Get the search term and year from the request
        $searchTerm = $request->input('search');
        $year = $request->input('year');

        // Fetch timetables based on the user's role, search term, and year
        if ($role == 'Teacher') {
            $timetables = Timetable::with('users')
                ->where('id', $user->id)
                ->when($searchTerm, function ($query) use ($searchTerm) {
                    return $query->where('timetable_classname', 'like', '%'. $searchTerm. '%');
                })
                ->when($year, function ($query) use ($year) {
                    return $query->where('timetable_classname', 'like', "$year%");
                })
                ->get();
        } else if ($role == 'Parent') {
            $timetables = Timetable::when($searchTerm, function ($query) use ($searchTerm) {
                    return $query->where('timetable_classname', 'like', '%'. $searchTerm. '%');
                })
                ->when($year, function ($query) use ($year) {
                    return $query->where('timetable_classname', 'like', "$year%");
                })
                ->get();
        } else if ($role == 'Kafa') {
            $timetables = Timetable::when($searchTerm, function ($query) use ($searchTerm) {
                    return $query->where('timetable_classname', 'like', '%'. $searchTerm. '%');
                })
                ->when($year, function ($query) use ($year) {
                    return $query->where('timetable_classname', 'like', "$year%");
                })
                ->get();
        } else {
            // Handle the case where the role is neither Teacher nor Parent
            abort(403, 'Unauthorized action.');
        }

        // Return the appropriate view based on the user's role
        if ($role == 'Teacher') {
            return view('ManageTimetable.Teacher.TimetableList', compact('timetables'));
        } else if ($role == 'Parent') {
            return view('ManageTimetable.Parent.TimetableList', compact('timetables'));
        } else if ($role == 'Kafa') {
            return view('ManageTimetable.KAFAAdmin.TimetableList', compact('timetables'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        // Retrieve all users with the role of 'Teacher'
        $teachers = User::where('role', 'Teacher')->get();

        // Return the view with the teachers data
        return view('ManageTimetable.KAFAAdmin.TimetableAdd', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $rules = [
            'class_teacher' => 'required',
            'class_name' => 'required',
        ];

        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        $times = [1, 2, 3, 4, 5, 6];

        foreach ($days as $day) {
            foreach ($times as $time) {
                $field = $day. $time;
                $rules[$field] = 'nullable'; // make the subject fields optional
            }
        }

        $request->validate($rules);

        // Create the timetable
        $timetable = new Timetable();
        $timetable->userID = $request->input('class_teacher'); // Get the selected userID from the class_teacher select tag
        $timetable->timetable_classname = $request->input('class_name');
        $timetable->timetable_year = now()->year; // Set the current year as the timetable_year

        foreach ($days as $day) {
            foreach ($times as $time) {
                $field = $day. $time;
                $subject = $request->input($field);
                if ($subject) {
                    $timetable->$field = $subject; // Store the subject data in the timetable model
                }
            }
        }

        $timetable->save();

        // Redirect the user back to the timetable list page
        return redirect()->route('manage.timetable.list')->with('success', 'Timetable created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function display(string $id)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get the user's role
        $role = $user->role;

        // Get the authenticated user's ID (assuming you are using Laravel's built-in auth system)
        $teacherID = $user->id;

        // Fetch the specific timetable by ID, including the related user
        $specificTimetable = Timetable::with('user')->where('id', $id)->firstOrFail();

        // Fetch all timetables for the authenticated user, including the related user
        $timetables = Timetable::with('user')->where('userID', $teacherID)->get();

        // Fetch the class name from the specific timetable (assuming classname is a field in the timetables table)
        $timetable_classname = $specificTimetable->timetable_classname;

        // Retrieve all users who have the role of 'Teacher'
        // This is likely to populate a dropdown or selection list in the edit form
        $teachers = User::where('role', 'Teacher')->get();
        
        // Based on the user's role, return the appropriate view
        if ($role == 'Teacher') {
            // Return the view for teachers
            return view('ManageTimetable.Teacher.TimetableView', compact('specificTimetable', 'timetables', 'timetable_classname'));
        } else if ($role == 'Parent') {
            // Return the view for parents
            return view('ManageTimetable.Parent.TimetableView', compact('specificTimetable', 'timetables', 'timetable_classname'));
        } else if ($role == 'Kafa') {
            // Return the view for KAFA admins
            return view('ManageTimetable.KAFAAdmin.TimetableView', compact('specificTimetable', 'timetables', 'timetable_classname'));
        } else {
            // Handle the case where the role is neither Teacher nor Parent nor KAFA
            abort(403, 'Unauthorized action.');
        }
    }


    /**
     * Edit a timetable record.
     */
    public function edit(string $id)
    {
        // Find the timetable record by its ID
        $timetable = Timetable::find($id);

        // Retrieve all users who have the role of 'Teacher'
        // This is likely to populate a dropdown or selection list in the edit form
        $teachers = User::where('role', 'Teacher')->get();

        // Pass the timetable and teachers data to the TimetableEdit view
        // This view will likely display a form to edit the timetable record
        // and include a dropdown or selection list of teachers to assign to the timetable
        return view('ManageTimetable.KAFAAdmin.TimetableEdit', compact('timetable', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data to ensure it meets the required rules
        $rules = [
            'class_teacher' => 'required', // The class teacher field is required
            'class_name' => 'required', // The class name field is required
        ];

        // Define the days of the week and time slots
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        $times = [1, 2, 3, 4, 5];

        // Loop through each day and time slot to create rules for the subject fields
        foreach ($days as $day) {
            foreach ($times as $time) {
                $field = $day. $time; // Create a field name, e.g. "monday1"
                $rules[$field] = 'nullable'; // Make the subject fields optional
            }
        }

        // Validate the request data against the defined rules
        $request->validate($rules);

        // Update the timetable
        $timetable = Timetable::find($id); // Find the timetable record by its ID

        // Update the timetable fields
        $timetable->userID = $request->input('class_teacher'); // Get the selected userID from the class_teacher select tag
        $timetable->timetable_classname = $request->input('class_name');
        $timetable->timetable_year = now()->year; // Set the current year as the timetable_year

        // Loop through each day and time slot to update the subject fields
        foreach ($days as $day) {
            foreach ($times as $time) {
                $field = $day. $time; // Create a field name, e.g. "monday1"
                $subject = $request->input($field);
                if ($subject) {
                    $timetable->$field = $subject; // Update the subject data in the timetable model
                }
            }
        }

        // Save the updated timetable
        $timetable->save();

        // Redirect to the timetable list page with a success message
        return redirect()->route('manage.timetable.list')
            ->with('success', 'Timetable updated successfully.');
    }

    /**
     * Delete a timetable record.
     */
    public function delete($id)
    {
        try {
            // Temporarily disable foreign key checks to avoid any constraints issues
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            // Find the timetable record by its ID and delete it
            $timetable = Timetable::findOrFail($id);
            $timetable->delete();

            // Redirect to the timetable list page with a success message
            return redirect()->route('manage.timetable.list')->with('success', 'Timetable deleted successfully.');
        } catch (\Exception $e) {
            // Catch any exceptions that occur during the deletion process
            // and redirect back to the previous page with an error message
            return back()->withErrors(['error' => 'Failed to delete timetable.']);
        } finally {
            // Re-enable foreign key checks to maintain data integrity
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }

    /**
     * Display a confirmation page to delete a timetable record.
     */
    public function confirm($id)
    {
        // Find the timetable record by its ID
        $timetable = Timetable::findOrFail($id);

        // Pass the timetable record to the view and display the confirmation page
        return view('ManageTimetable.KAFAAdmin.TimetableDelete', compact('timetable'));
    }

    /**
     * Display the teacher template timetable page.
     */
    public function teacherTemplateTimetable()
    {
        // Render the teacher template timetable view
        return view('ManageTimetable.Teacher.TeacherTemplate');
    }

    /**
     * Display the parent template timetable page.
     */
    public function parentTemplateTimetable()
    {
        // Render the parent template timetable view
        return view('ManageTimetable.Parent.ParentTemplate');
    }


    /**
     * Display the timetable change request form for a teacher.
     *
     * @param int $timetableID The ID of the timetable for which the change request is being made
     */
    public function addRequest($timetableID)
    {
        // Get the current user's ID (i.e. the teacher making the request)
        $userid = Auth::id();

        // Render the timetable change request view, passing the user ID and timetable ID
        return view('ManageTimetable.Teacher.TimetableChangeRequest', compact('userid', 'timetableID'));
    }

    /**
     * Store a new timetable request in the database.
     *
     * @param Request $request The HTTP request containing the request data
     */
    public function storeRequest(Request $request)
    {
        // Validate the request data to ensure it meets the required format
        $validated = $request->validate([
            'day' => 'required|string', // Day of the week (e.g. Monday, Tuesday, etc.)
            'time' => 'required|string', // Time of the day (e.g. 9:00 AM, 2:00 PM, etc.)
            'subject' => 'required|string', // Subject of the timetable request (e.g. Math, English, etc.)
            'comment' => 'nullable|string', // Optional comment or reason for the request
        ]);

        $timetableRequest = new TimetableRequest();

        // Set the teacher ID to the current authenticated user's ID
        $timetableRequest->teacherID = Auth::id();

        // Set the timetable ID (not the entire timetable instance)
        $timetableRequest->timetableID = $request->input('timetableID');

        // Set the request details from the validated data
        $timetableRequest->request_day = $validated['day'];
        $timetableRequest->request_time = $validated['time'];
        $timetableRequest->request_subject = $validated['subject'];
        $timetableRequest->request_reason = $validated['comment'];

        // Save the new request to the database
        $timetableRequest->save();

        // Redirect to the timetable list page with a success message
        return redirect()->route('manage.timetable.list')->with('success', 'Timetable request created successfully!');
    }

    /**
     * Display a list of timetables with pending change requests.
     *
     * @param Request $request The HTTP request
     */
    public function displayRequestList(Request $request)
    {
        // Retrieve a list of timetables that have at least one pending change request
        $timetables = Timetable::whereHas('timetableRequest')->get();

        // Render the timetable change request list view, passing the list of timetables
        return view('ManageTimetable.KAFAAdmin.TimetableChangeRequestList', compact('timetables'));
    }

    /**
     * Display the details of a specific timetable change request.
     *
     * @param Request $request The HTTP request
     * @param int $requestID The ID of the timetable request to display
     */
    public function displayRequest(Request $request, $requestID)
    {
        // Retrieve the timetable request with the given requestID, including related user data
        // Eager load the 'user' relationship to include the user's details in the request
        $timetableRequest = TimetableRequest::with('user')->findOrFail($requestID);

        // If the request is not found, a 404 error will be thrown by the findOrFail method

        // Return the view with the timetable request details
        // The compact function is used to pass the $timetableRequest variable to the view
        return view('ManageTimetable.KAFAAdmin.TimetableChangeRequestView', compact('timetableRequest'));
    }
}
