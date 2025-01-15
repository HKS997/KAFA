@extends('ManageRegistration.Teacher.template')

@section('content')
    <div class="container mt-5">
        <h2>Add New Result for {{ $student->studentName }}</h2>

        <!-- Add Result Form -->
        <form action="{{ route('results.store') }}" method="POST">
            @csrf <!-- CSRF protection token -->

            <!-- Hidden input field for student ID -->
            <input type="hidden" id="studentIC" name="studentIC" value="{{ $student->studentIC }}">

            <!-- Input field for student name (readonly) -->
            <div class="mb-3">
                <label for="studentName" class="form-label">Student Name</label>
                <input type="text" class="form-control" id="studentName" name="studentName"
                    value="{{ $student->studentName }}" readonly>
            </div>

            <!-- Dropdown for selecting subject -->
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <select class="form-control" id="subjectName" name="subject" required>
                    @foreach ($subjects as $subject)
                        <!-- Loop through each subject -->
                        <option value="{{ $subject->id }}">{{ $subject->subjectName }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Input field for mark -->
            <div class="mb-3">
                <label for="mark" class="form-label">Mark</label>
                <input type="number" class="form-control" id="mark" name="mark" required>
            </div>

            <!-- Input field for grade -->
            <div class="mb-3">
                <label for="grade" class="form-label">Grade</label>
                <input type="text" class="form-control" id="grade" name="grade" required>
            </div>

            <!-- Submit button for the form -->
            <button type="submit" class="btn btn-success">Add Result</button>
        </form>
    </div>
@endsection
