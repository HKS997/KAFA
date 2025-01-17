@extends('ManageRegistration.Teacher.template')

@section('content')
    <div class="container mt-5">
        <h2>Search Activities</h2>

        <form method="GET" action="{{ route('teacher.activities.index') }}">
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

        <!-- Search Results -->
        <h2>Search Results:</h2>
        <div class="list-group" id="activityList">
            @if ($activities->isEmpty())
                <p>No activities found.</p>
            @else
                @foreach ($activities as $activity)
                    <a href="{{ route('activities.show', $activity->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        {{ $activity->activityName }} ({{ $activity->activityDate }})
                        <span class="badge badge-custom {{ $activity->status == 'Ongoing' ? 'badge-warning' : 'badge-success' }} text-dark">
                            {{ $activity->status }}
                        </span>
                    </a>
                @endforeach
            @endif
        </div>

        <!-- Alert for No Results -->
        <div class="alert alert-danger mt-3" role="alert" id="notFoundAlert" style="display: none;">
            No activities found.
        </div>

        <!-- Button to Create New Activity -->
        <a href="{{ route('activities.create') }}" class="btn btn-primary mt-3">Create New Activity</a>
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
        function searchActivities() {
            var searchTerm = document.getElementById('searchInput').value.toLowerCase();
            var activityList = document.getElementById('activityList');
            var activities = activityList.getElementsByClassName('list-group-item');
            var activityFound = false;

            for (var i = 0; i < activities.length; i++) {
                var activityName = activities[i].textContent.toLowerCase();

                if (activityName.includes(searchTerm)) {
                    activities[i].style.display = "";
                    activityFound = true;
                } else {
                    activities[i].style.display = "none";
                }
            }

            var notFoundAlert = document.getElementById('notFoundAlert');
            if (!activityFound) {
                notFoundAlert.style.display = "";
            } else {
                notFoundAlert.style.display = "none";
            }
        }
    </script>

      <script>
public function index(Request $request)
{
    $searchTerm = $request->input('search_term');
    $query = Activity::query();

    if ($searchTerm) {
        $query->where('activityName', 'LIKE', '%' . $searchTerm . '%');

        // Check if searchTerm is a valid date format
        if (strtotime($searchTerm)) {
            $query->orWhereDate('activityDate', $searchTerm);
        }
    }

    $activities = $query->get();

    return view('ManageKAFAactivity.Teacher.ViewActivity1', compact('activities', 'searchTerm'));
}

    // Debugging: Output the search term and results
    dd(['search_term' => $searchTerm, 'activities' => $activities]);

    // Return to the view
    return view('ManageKAFAactivity.Teacher.ViewActivity1', compact('activities', 'searchTerm'));
}

    </script>
@endsection
