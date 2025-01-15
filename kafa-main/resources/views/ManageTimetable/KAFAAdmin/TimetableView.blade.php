@extends('ManageTimetable.KAFAAdmin.KafaTemplate')

@section('kafapunya')
<div class="container">
<div class="card" style="margin-left: auto; margin-right: auto; width: 70%; margin-top: 20px;">
  <div class="card-body d-flex justify-content-between align-items-center">
    <div>Class teacher: {{ $specificTimetable->name }}</div>
    <div>Class: {{ $timetable_classname }}</div>
</div>
  <div class="card-body d-flex justify-content-center align-items-center">
      <div style="width: 100%;">
          @if($timetables)
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
                  @endphp

                    @foreach($days as $day)
                        <tr style="background-color: {{ $loop->even ? '#f2f2f2' : '#e6f3ff' }};">
                            <th scope="row" style="padding: 8px; border: 2px solid #343c44;">{{ $day }}</th>
                            @foreach($times as $time)
                                @if($time == 4)
                                <td style="padding: 8px; border: 2px solid #343c44; background-color: #343c44; color: white;">Recess</td>
                                @elseif(in_array($time, [1, 2, 3, 5, 6]))
                                    @php
                                        $field = strtolower($day) . $time;
                                    @endphp
                                    <td style="padding: 8px; border: 2px solid #343c44;">{{ $specificTimetable->$field }}</td>
                                @else
                                    <td style="padding: 8px; border: 2px solid #343c44;"></td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
              </tbody>
          </table>

            <!-- Back button -->
            <div class="mt-3 d-flex justify-content-end">
                <a href="javascript:history.back()" class="btn btn-dark" style="background-color: #343c44; color: white; border-radius: 5px;">Back</a>
            </div>

          @else
          <p>No timetable available.</p>
          @endif
      </div>
  </div>
</div>
</div>
@endsection
