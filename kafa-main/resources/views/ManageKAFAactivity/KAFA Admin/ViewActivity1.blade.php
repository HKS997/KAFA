<!-- resources/views/ManageKAFAactivity/Teacher/ViewActivity1.blade.php -->

@extends('ManageRegistration.Kafa Admin.template')

@section('content')
<h2>Search Activities</h2>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('kafa.activities.index') }}">
    <div class="input-group mb-3">
        <input 
            type="text" 
            name="search_term" 
            class="form-control" 
            placeholder="Search by name or date (YYYY-MM-DD)" 
            value="{{ request('search_term') }}">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary btn-custom" type="submit">Search</button>
        </div>
    </div>
</form>

    <!-- List of Activities -->
    <div class="list-group" id="activityList">
        @foreach ($activities as $activity)
            <button type="button"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="window.location='{{ route('KAFAadmin.activities.show', $activity->id) }}'">
                <span>{{ $activity->activityName }}</span>
                <span
                    class="badge badge-custom {{ $activity->status == 'Ongoing' ? 'badge-warning' : 'badge-success' }} text-dark">
                    {{ $activity->status }}
                </span>
            </button>
        @endforeach

    </div>

    <!-- Alert for Activity Not Available -->
    <div class="alert alert-danger mt-3" role="alert" id="notFoundAlert" style="display: none;">
        Activity not found.
    </div>

    <style>
        .badge-custom {
            border: 1px solid #000;
            border-radius: 5px;
            padding: 0.25em 0.75em;
        }

        .btn-custom {
            background-color: yellow;
            border-color: yellow;
            color: black;
            margin-left: 5px;
        }

        .input-group-append {
            display: flex;
            align-items: center;
        }
    </style>

    <script>
        function searchActivity() {
            var searchInput = document.getElementById('searchInput').value.toLowerCase();
            var activityList = document.getElementById('activityList');
            var activityButtons = activityList.getElementsByClassName('list-group-item');

            var activityFound = false;

            for (var i = 0; i < activityButtons.length; i++) {
                var activityName = activityButtons[i].getElementsByTagName('span')[0].textContent.toLowerCase();
                if (activityName.includes(searchInput)) {
                    activityButtons[i].style.display = "block";
                    activityFound = true;
                } else {
                    activityButtons[i].style.display = "none";
                }
            }

            if (!activityFound) {
                document.getElementById('notFoundAlert').style.display = "block";
            } else {
                document.getElementById('notFoundAlert').style.display = "none";
            }
        }
    </script>
@endsection
