<!-- Blade view file: resources/views/ManageStudentResult/MUIP_Admin/muipSearch.blade.php -->

@extends('ManageRegistration.Muip Admin.template')

@section('content')
<div class="container mt-5">
    <h2>Student Results</h2>

    <!-- Card to display the results table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <!-- Table to display student results -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Mark</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $result) <!-- Loop through each result -->
                            <tr>
                                <td>{{ $result->subject->subjectName }}</td>
                                <td>{{ $result->resultMark }}</td>
                                <td>{{ $result->grade }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
