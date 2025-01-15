<!-- resources/views/ManageKAFAactivity/Teacher/EditActivity.blade.php -->

@extends('ManageRegistration.Teacher.template')

@section('content')
<div class="container">
    <h1>Edit Activity</h1>

    <form action="{{ route('activities.update', $activity->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="activityName">Activity Name</label>
            <input type="text" class="form-control" id="activityName" name="activityName" value="{{ $activity->activityName }}" required>
        </div>
        <div class="form-group">
            <label for="activityDescription">Description</label>
            <textarea class="form-control" id="activityDescription" name="activityDescription" rows="3" required>{{ $activity->activityDescription }}</textarea>
        </div>
        <div class="form-group">
            <label for="activityDate">Date</label>
            <input type="date" class="form-control" id="activityDate" name="activityDate" value="{{ $activity->activityDate }}" required>
        </div>
        <div class="form-group">
            <label for="activityTime">Time</label>
            <input type="time" class="form-control" id="activityTime" name="activityTime" value="{{ $activity->activityTime }}" required>
        </div>
        <div class="form-group">
            <label for="activityTentative">Tentative</label>
            <input type="text" class="form-control" id="activityTentative" name="activityTentative" value="{{ $activity->activityTentative }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Activity</button>
    </form>
</div>
@endsection
