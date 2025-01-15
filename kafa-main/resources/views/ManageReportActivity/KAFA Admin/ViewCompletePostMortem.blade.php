@extends('ManageRegistration.Kafa Admin.template')

@section('content')
    <div class="container">
        <div class="card mb-3 mt-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title"><strong>{{ $activity->activityName }}</strong></h5>
                    <h6 class="card-subtitle text-muted"><strong>Date:</strong> {{ $activity->activityDate }}</h6>
                </div>
                <p class="mt-3"> {{ $activity->activityDescription }}</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($activity->postMortems->isEmpty())
            <p>No post-mortem reports available for this activity.</p>
        @else
            <ul class="list-group">
                @foreach ($activity->postMortems as $postMortem)
                    <li class="list-group-item">
                        <h5>Post-Mortem Reports</h5>
                        <p> {{ $postMortem->postDescription }}</p>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('report.EditPostMortemForm', ['id' => $activity->id, 'postMortemId' => $postMortem->id]) }}"
                class="btn btn-warning mt-3 float-right">Edit</a>
        @endif

        <a href="{{ route('report.ViewActivityList') }}" class="btn btn-secondary mt-3 float-right ml-3">Back</a>
    </div>
@endsection
