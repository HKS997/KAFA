<!-- resources/views/post_mortem/create.blade.php -->
@extends('ManageRegistration.Kafa Admin.template')

@section('content')
<div class="container">
    <h2>Create Post Mortem</h2>

    <form method="POST" action="{{ route('report.PostMortemStore', $activity->id) }}">
        @csrf
        <div class="form-group">
            <textarea class="form-control" id="postDescription" name="postDescription" rows="3" required></textarea>
        </div>
        <div class="d-flex mt-3">
            <button type="submit" class="btn btn-yellow mr-2">Submit</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary ml-2">Back</a>
        </div>
    </form>
</div>

<!-- Custom Styles -->
<style>
    .btn-yellow {
        background-color: yellow;
        border-color: yellow;
        color: black;
    }
    .btn-yellow:hover {
        background-color: darkorange;
        border-color: darkorange;
    }
    .mt-3 {
        margin-top: 1rem;
    }
    .mr-2 {
        margin-right: 0.5rem;
    }
    .ml-2 {
        margin-left: 0.5rem;
    }
</style>
@endsection
