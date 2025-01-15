@extends('ManageRegistration.Kafa Admin.template')

@section('content')
    <div class="container">
        <div class="card mb-3 mt-4">
            <div class="card-body">
                <h4 class="card-title">Edit Post-Mortem for Activity: {{ $activity->activityName }}</h4>

                <form method="POST"
                    action="{{ route('report.PostMortemUpdate', ['id' => $activity->id, 'postMortemId' => $postMortem->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <textarea class="form-control" id="postDescription" name="postDescription" rows="5" required>{{ $postMortem->postDescription }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-warning mt-3">Submit</button>
                    <a href="{{ route('report.ViewCompletePostMortem', $activity->id) }}"
                        class="btn btn-secondary mt-3">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
