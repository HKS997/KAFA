@extends('ManageRegistration.Teacher.template')

@section('content')
<div class="container mt-5">
    <h2>Delete Student Result</h2>
    <p>Student Name: {{ $student->studentName }}</p>

    <!-- Card to display the results table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <!-- Table to display student results with delete option -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Mark</th>
                            <th>Grade</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $result) <!-- Loop through each result -->
                        <tr>
                            <td>{{ $result->subjectName }}</td>
                            <td>{{ $result->resultMark }}</td>
                            <td>{{ $result->grade }}</td>
                            <td>
                                <!-- Form to delete a result -->
                                <form action="{{ route('results.delete', ['studentIC' => $student->studentIC, 'result_id' => $result->id]) }}" method="POST">
                                    @csrf <!-- CSRF protection token -->
                                    @method('DELETE') <!-- Method to specify HTTP DELETE -->
                                    <button type="submit" class="btn btn-danger">Delete</button> <!-- Delete button -->
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
