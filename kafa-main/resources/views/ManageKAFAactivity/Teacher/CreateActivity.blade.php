<!-- resources/views/ManageKAFAactivity/Teacher/CreateActivity.blade.php -->

@extends('ManageRegistration.Teacher.template')

@section('content')
<h1>Create New Activity</h1>

<form action="{{ route('activities.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Activity Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>
    <div class="form-group">
        <label for="time">Time</label>
        <input type="time" class="form-control" id="time" name="time" required>
    </div>
    <div class="form-group">
        <label for="tentative">Tentative</label>
        <input type="text" class="form-control" id="tentative" name="tentative" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Activity</button>
</form>
@endsection
