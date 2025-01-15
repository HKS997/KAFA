@extends('ManageTimetable.KAFAAdmin.KafaTemplate')

@section('kafapunya')
<div class="container">
    <div class="card" style="margin-left: auto; margin-right: auto; width: 70%; margin-top: 20px;">
        <div class="card-header">
            <div>CLASS TIMETABLE LIST</div>
        </div>
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <form method="POST" action="{{ route('manage.timetable.list.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="class_teacher">Class Teacher:</label>
                            <select name="class_teacher" id="class_teacher" class="form-control">
                                <option value="">Select Class Teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="class_name">Class Name:</label>
                            <input type="text" name="class_name" id="class_name" class="form-control">
                        </div>
                    </div>
                
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
                                $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
                                $times = [1, 2, 3, 4, 5, 6];
                                $subjects = ['LUGHATUL QURAN', 'AQIDAH', 'IBADAH', 'SIRAH', 'TILAWAH', 'JAWI', 'AMALI']; // Replace with your subject options
                            @endphp
                
                            @foreach($days as $day)
                                <tr style="background-color: {{ $loop->even ? '#f2f2f2' : '#e6f3ff' }};">
                                    <th scope="row" style="padding: 8px; border: 2px solid #343c44;">{{ ucfirst($day) }}</th>
                                    @foreach($times as $time)
                                        @if($time == 4)
                                            <td style="padding: 8px; border: 2px solid #343c44; background-color: #343c44; color: white;">Recess</td>
                                        @elseif(in_array($time, [1, 2, 3, 5, 6]))
                                            @php
                                                $field = $day . $time;
                                            @endphp
                                            <td style="padding: 8px; border: 2px solid #343c44;">
                                                <select name="{{ $field }}" class="form-control">
                                                    <option value="">Select Subject</option>
                                                    @foreach($subjects as $subject)
                                                        <option value="{{ $subject }}">{{ $subject }}</option>
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
                
                    <!-- Submit and Cancel buttons -->
                    <div class="mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn" style="border-radius: 5px; background-color: #343a40; color: white; margin-right: 10px;">Add</button>
                        <a href="javascript:history.back()" class="btn" style="border-radius: 5px; background-color: white; color: black; border: 2px solid #343a40;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection