@extends('ManageRegistration.Teacher.template')

@section('content')
    <div class="container">
        <div class="card mb-3 mt-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title"><strong>{{ $activity->activityName }}</strong></h5>
                    <h6 class="card-subtitle text-muted"><strong>Date:</strong> {{ $activity->activityDate }}</h6>
                </div>
                <p class="mt-3"><strong>Description: </strong>{{ $activity->activityDescription }}</p>
                <p class="mt-3"><strong>Tentative: </strong>{{ $activity->activityTentative }}</p>
                <p class="mt-3"><strong>Time: </strong>{{ $activity->activityTime }}</p>

                <!-- Edit Button -->
                <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-primary">Edit</a>

                <!-- Delete Button -->
                <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-center mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary ml-2">Back</a>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .text-white {
            color: white;
        }

        .btn-yellow {
            background-color: yellow;
            border-color: yellow;
            color: black;
        }

        .btn-yellow:hover {
            background-color: darkorange;
            border-color: darkorange;
        }

        .mr-2 {
            margin-right: 0.5rem;
        }

        .ml-2 {
            margin-left: 0.5rem;
        }
    </style>
@endsection
