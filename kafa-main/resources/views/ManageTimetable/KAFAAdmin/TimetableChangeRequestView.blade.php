@extends('ManageTimetable.KAFAAdmin.KafaTemplate')

@section('kafapunya')
<div class="container">
    <div class="card" style="margin: 20px auto; width: 70%;">
        <div class="card-header">
            <h4>TIMETABLE CHANGE REQUEST</h4>
        </div>
        <div class="card-body">
            <!-- Display Request Details -->
            <div class="form-group">
                <label for="user_name">Full Name</label>
                <input type="text" id="user_name" class="form-control" value="{{ $timetableRequest->user->name }}" readonly>
            </div>
            <br>
            <div class="form-group">
                <label for="day">Day</label>
                <input type="text" id="day" class="form-control" value="{{ $timetableRequest->request_day }}" readonly>
            </div>
            <br>
            <div class="form-group">
                <label for="time">Time</label>
                <input type="text" id="time" class="form-control" value="{{ $timetableRequest->request_time }}" readonly>
            </div>
            <br>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" class="form-control" value="{{ $timetableRequest->request_subject }}" readonly>
            </div>
            <br>
            <div class="form-group">
                <label for="comment">Reason</label>
                <textarea id="comment" class="form-control" rows="3" readonly>{{ $timetableRequest->request_reason }}</textarea>
            </div>
            <br>
            <!-- Back button -->
            <div class="mt-3 d-flex justify-content-end">
                <a href="javascript:history.back()" class="btn btn-dark" style="background-color: #343c44; color: white; border-radius: 5px;">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection