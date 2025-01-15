<!-- resources/views/activity/show.blade.php -->
@extends('ManageRegistration.Kafa Admin.template')

@section('content')
    <div class="container">
        <div class="card mb-3 mt-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title"><strong>{{ $activity->activityName }}</strong></h5>
                    <h6 class="card-subtitle text-muted"><strong>Date:</strong> {{ $activity->activityDate }}</h6>
                </div>
                <p class="mt-3">{{ $activity->activityDescription }}</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($activity->postMortems->isEmpty())
            <p class="text-white">Post Mortem report has not been created yet.</p>
        @else
            <ul class="list-group">
                @foreach ($activity->postMortems as $postMortem)
                    <li class="list-group-item">
                        <h5>Post-Mortem Reports</h5>
                        <p>{{ $postMortem->postDescription }}</p>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('report.EditPostMortemForm', ['id' => $activity->id, 'postMortemId' => $postMortem->id]) }}"
                class="btn btn-warning mt-3 float-right">Edit</a>
        @endif

        <div class="d-flex justify-content-center mt-3">
            <!-- Create Post-Mortem Button -->
            <form method="POST" action="{{ route('report.AddPostMortemForm', $activity->id) }}" class="mr-2">
                @csrf
                <button type="submit" class="btn btn-yellow">Create Post-Mortem</button>
            </form>

            <!-- Back Button -->
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
