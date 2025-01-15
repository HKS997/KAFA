<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;

class ManageActivityController extends Controller
{


    public function index()
    {
        $activities = Activity::all();
        return view('ManageKAFAactivity.Teacher.ViewActivity1', compact('activities'));
    }
    public function KAFAindex()
    {
        $activities = Activity::all();
        return view('ManageKAFAactivity.KAFA Admin.ViewActivity1', compact('activities'));
    }

    public function MUIPindex()
    {
        $activities = Activity::all();
        return view('ManageKAFAactivity.MUIP Admin.ViewActivity1', compact('activities'));
    }

    public function Parentindex()
    {
        $activities = Activity::all();
        return view('ManageKAFAactivity.Parent.ViewActivity1', compact('activities'));
    }
    public function show(string $id)
    {
        //

            $activity = Activity::findOrFail($id);
            return view('ManageKAFAactivity.Teacher.ViewActivityDetail', ['activity' => $activity]);

    }
    public function create()
    {
        return view('ManageKAFAactivity.Teacher.CreateActivity');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i', // Ensure the time format is HH:MM
            'tentative' => 'required|string',
        ]);

        // Combine date and time into a single DateTime object
        $dateTime = $request->date . ' ' . $request->time;

        Activity::create([
            'activityName' => $request->name,
            'activityDescription' => $request->description,
            'activityDate' => $request->date,
            'activityTime' => $request->time,
            'activityTentative' => $request->tentative,
        ]);


        return redirect()->route('activities.search')->with('success', 'Activity created successfully.');
    }

    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        return view('ManageKAFAactivity.Teacher.EditActivity', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);

        $request->validate([
            'activityName' => 'required|string|max:255',
            'activityDescription' => 'required|string',
            'activityDate' => 'required|date',
            'activityTime' => 'required',
            'activityTentative' => 'required|string',
        ]);

        $activity->update([
            'activityName' => $request->activityName,
            'activityDescription' => $request->activityDescription,
            'activityDate' => $request->activityDate,
            'activityTime' => $request->activityTime,
            'activityTentative' => $request->activityTentative,
        ]);

        return redirect()->route('activities.search')->with('success', 'Activity updated successfully.');
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('activities.search')->with('success', 'Activity deleted successfully.');
    }

    public function KAFAshow(string $id)
    {
        //

        $activity = Activity::findOrFail($id);
        return view('ManageKAFAactivity.KAFA Admin.ViewActivityDetail', ['activity' => $activity]);
    }

    public function MUIPshow(string $id)
    {
        //

        $activity = Activity::findOrFail($id);
        return view('ManageKAFAactivity.MUIP Admin.ViewActivityDetail', ['activity' => $activity]);
    }

    public function Parentshow(string $id)
    {
        //

        $activity = Activity::findOrFail($id);
        return view('ManageKAFAactivity.Parent.ViewActivityDetail', ['activity' => $activity]);
    }
}
