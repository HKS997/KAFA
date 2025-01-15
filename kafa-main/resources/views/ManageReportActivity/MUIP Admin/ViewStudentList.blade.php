@extends('ManageRegistration.Muip Admin.template')

@section('content')
    <!-- Search Bar -->
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="searchInput" placeholder="Search..." aria-label="Search"
            aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary btn-custom" type="button" onclick="searchStudent()">Search</button>
        </div>
    </div>

    <!-- List of Students -->
    <div class="list-group" id="studentList">
        @foreach ($students as $student)
            <button type="button"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="window.location='{{ route('report.ViewAcademicPerformance', $student->studentIC) }}'">
                <span>{{ $student->studentName }}</span>
            </button>
        @endforeach
    </div>

    <a href="{{ route('report.AcademicYearOption')}}" class="btn btn-secondary mt-3 float-right ml-3">Back</a>

    <!-- Alert for Student Not Available -->
    <div class="alert alert-danger mt-3" role="alert" id="notFoundAlert" style="display: none;">
        Student not found.
    </div>

    <style>
        .btn-custom {
            background-color: yellow;
            border-color: yellow;
            color: black;
            margin-left: 5px;
            /* Adjust the margin to create a gap */
        }

        .input-group-append {
            display: flex;
            align-items: center;
        }
    </style>

    <script>
        function searchStudent() {
            var searchInput = document.getElementById('searchInput').value.toLowerCase();
            var studentList = document.getElementById('studentList');
            var studentButtons = studentList.getElementsByClassName('list-group-item');

            var studentFound = false;

            for (var i = 0; i < studentButtons.length; i++) {
                var studentName = studentButtons[i].getElementsByTagName('span')[0].textContent.toLowerCase();
                if (studentName.includes(searchInput)) {
                    studentButtons[i].style.display = "block";
                    studentFound = true;
                } else {
                    studentButtons[i].style.display = "none";
                }
            }

            if (!studentFound) {
                document.getElementById('notFoundAlert').style.display = "block";
            } else {
                document.getElementById('notFoundAlert').style.display = "none";
            }
        }
    </script>
@endsection
