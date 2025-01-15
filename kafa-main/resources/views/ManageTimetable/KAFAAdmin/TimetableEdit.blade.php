@extends('ManageTimetable.KAFAAdmin.KafaTemplate')

@section('kafapunya')
<div class="container">
    <div class="card" style="margin-left: auto; margin-right: auto; width: 70%; margin-top: 20px;">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <form method="POST" action="{{ route('manage.timetable.list.update', $timetable) }}">
                    @method('PUT')
                    @csrf
                    <label for="class_teacher">Class Teacher:</label>
                    <input type="hidden" name="timetable" value="{{ $timetable->id }}">
                    <select name="class_teacher" id="class_teacher" class="form-control">
                        <option value="">Select Class Teacher</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ $timetable->userID == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                        @endforeach
                    </select>
            </div>
            <div>
                <label for="class_name">Class Name:</label>
                <input type="text" name="class_name" id="class_name" class="form-control" value="{{ $timetable->timetable_classname }}">
            </div>
        </div>
        <div class="card-body d-flex justify-content-center align-items-center">
            <div style="width: 100%;">
                <table class="table" style="width: 100%; border-collapse: collapse;">
                    <thead class="thead-dark" style="background-color: #343a40; color: white;">
                        <tr>
                            <th scope="col" style="padding: 8px; border: 2px solid #343c44;">Day/Time</th>
                            <th scope="col" style="padding: 8px; border: 2px solid #343c44;">2:30 - 3:00</th>
                            <th scope="col" style="padding: 8px; border: 2px solid #343c44;">3:00 - 3:30</th>
                            <th scope="col" style="padding: 8px; border: 2px solid #343c44;">3:30 - 4:00</th>
                            <th scope="col" style="padding: 8px; border: 2px solid #343c44;">4:00 - 4:30</th>
                            <th scope="col" style="padding: 8px; border: 2px solid #343c44;">4:30 - 5:00</th>
                            <th scope="col" style="padding: 8px; border: 2px solid #343c44;">5:00 - 5:30</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                            $times = ['1', '2', '3', '4', '5', '6'];
                            $subjects = ['LUGHATUL QURAN', 'AQIDAH', 'IBADAH', 'SIRAH', 'TILAWAH', 'JAWI', 'AMALI']; // Replace with your subject options
                        @endphp

                    @foreach($days as $day)
                    <tr style="background-color: {{ $loop->even? '#f2f2f2' : '#e6f3ff' }};">
                        <th scope="row" style="padding: 8px; border: 2px solid #343c44;">{{ $day }}</th>
                        @foreach($times as $time)
                            @if($time == 4)
                                <td style="padding: 8px; border: 2px solid #343c44; background-color: #343c44; color: white;">Recess</td>
                            @elseif(in_array($time, [1, 2, 3, 5, 6]))
                                @php
                                    $field = strtolower($day). $time;
                                    $subject = $timetable->$field;
                                @endphp
                                <td style="padding: 8px; border: 2px solid #343c44;">
                                    <select name="{{ $field }}" class="form-control">
                                        <option value="">Select Subject</option>
                                        @foreach($subjects as $subjectOption)
                                            @php
                                                $selected = $timetable->$field == $subjectOption ? 'selected' : '';
                                            @endphp
                                            <option value="{{ $subjectOption }}" {{ $selected }}>{{ $subjectOption }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            @else
                                <td style="padding: 8px; border: 2px solid #343c44;"></td>
                            @endif
                        @endforeach
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Submit button -->
                <div class="mt-3 d-flex justify-content-end">
                    <button type="submit" class="btn" style="border-radius: 5px; background-color: #343a40; color: white; margin-right: 10px;">Save</button>
                    <a href="javascript:history.back()" class="btn" style="border-radius: 5px; background-color: white; color: black; border: 2px solid #343a40;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection