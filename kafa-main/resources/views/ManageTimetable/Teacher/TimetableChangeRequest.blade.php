@extends('ManageTimetable.Teacher.TeacherTemplate')

@section('contentTTimetable')
<div class="container">
    <div class="card" style="margin: 20px auto; width: 70%;">
        <div class="card-header">
            <h4>TIMETABLE CHANGE REQUEST</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('manage.timetable.list.reqrecord') }}" id="timetable-form">
                @csrf
                <!-- Hidden input field for timetableID -->
                <input type="hidden" name="timetableID" value="{{ $timetableID }}">

                <!-- Display User's Name -->
                <div class="form-group">
                    <label for="user_name">Full Name</label>
                    <input type="text" id="user_name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                </div>
                <br>
                <!-- Select Day -->
                <div class="form-group">
                    <label for="day">Day</label>
                    <select name="day" id="day" class="form-control">
                        <option value="" selected>Choose day</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                    </select>
                </div>
                <br>
                <!-- Select Time -->
                <div class="form-group">
                    <label for="time">Time</label>
                    <select name="time" id="time" class="form-control">
                        <option value="" selected>Choose time</option>
                        <option value="2:30 - 3:00">2:30 - 3:00</option>
                        <option value="3:00 - 3:30">3:00 - 3:30</option>
                        <option value="3:30 - 4:00">3:30 - 4:00</option>
                        <option value="4:30 - 5:00">4:30 - 5:00</option>
                        <option value="5:00 - 5:30">5:00 - 5:30</option>
                    </select>
                </div>
                <br>
                <!-- Select Subject -->
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <select name="subject" id="subject" class="form-control">
                        <option value="" selected>Choose subject</option>
                        <option value="LUGHATUL QURAN">LUGHATUL QURAN</option>
                        <option value="AQIDAH">AQIDAH</option>
                        <option value="IBADAH">IBADAH</option>
                        <option value="SIRAH">SIRAH</option>
                        <option value="TILAWAH">TILAWAH</option>
                        <option value="JAWI">JAWI</option>
                        <option value="AMALI">AMALI</option>
                    </select>
                </div>
                <br>
                <!-- Comment Input -->
                <div class="form-group">
                    <label for="comment">Reason</label>
                    <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Give your reason here..."></textarea>
                </div>
<br>
                <!-- Submit button -->
                <div class="mt-3 d-flex justify-content-end">
                    <button type="submit" class="btn" style="border-radius: 5px; background-color: #343a40; color: white; margin-right: 10px;">Submit</button>
                    <a href="{{ route('manage.timetable.list') }}" class="btn" style="border-radius: 5px; background-color: white; color: black; border: 2px solid #343a40;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('timetable-form').addEventListener('submit', function(event) {
        var day = document.getElementById('day').value;
        var time = document.getElementById('time').value;
        var subject = document.getElementById('subject').value;

        if (day === '' || time === '' || subject === '') {
            event.preventDefault();
            alert('Please select all required options');
        }
    });
</script>

@endsection