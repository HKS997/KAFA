@extends('ManageRegistration.Teacher.template')

@section('content')
<div class="container mt-5">
    <h2>Edit Result for {{ $student->studentName }}</h2>

    <!-- Edit Result Form -->
    <form action="{{ route('results.update', $result->id) }}" method="POST">
        @csrf <!-- CSRF protection token -->
        @method('PUT') <!-- Method to specify HTTP PUT for update -->

        <!-- Hidden input field for student ID -->
        <input type="hidden" id="studentIC" name="studentIC" value="{{ $student->studentIC }}">

        <!-- Input field for student name (readonly) -->
        <div class="mb-3">
            <label for="studentName" class="form-label">Student Name</label>
            <input type="text" class="form-control" id="studentName" name="studentName" value="{{ $student->studentName }}" readonly>
        </div>

        <!-- Dropdown for selecting subject -->
        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <select class="form-control" id="subjectName" name="subject" required>
                @foreach($subjects as $subject) <!-- Loop through each subject -->
                    <option value="{{ $subject->id }}" {{ $subject->subjectName == $result->subjectName ? 'selected' : '' }}>
                        {{ $subject->subjectName }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Input field for mark -->
        <div class="mb-3">
            <label for="mark" class="form-label">Mark</label>
            <input type="number" class="form-control" id="mark" name="mark" value="{{ $result->resultMark }}" required>
        </div>

        <!-- Input field for grade -->
        <div class="mb-3">
            <label for="grade" class="form-label">Grade</label>
            <input type="text" class="form-control" id="grade" name="grade" value="{{ $result->grade }}" required>
        </div>

        <!-- Submit button for the form -->
        <button type="submit" class="btn btn-success">Update Result</button>
    </form>
</div>
@endsection
