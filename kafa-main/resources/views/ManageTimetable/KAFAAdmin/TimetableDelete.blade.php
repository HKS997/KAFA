@extends('ManageTimetable.KAFAAdmin.KafaTemplate')

@section('kafapunya')
<div class="container">
    <div class="card" style="margin-left: auto; margin-right: auto; width: 50%; margin-top: 20px; text-align: center;">
        <div class="card-body" style="background-color: #C6D2FF;">
            <p>Are you sure you want to DELETE this table?</p>
            <div class="d-flex justify-content-center mt-4">
                <form method="POST" action="{{ route('manage.timetable.list.destroy', $timetable->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="margin-right: 10px;">Yes</button>
                </form>
                <a href="javascript:history.back()" class="btn btn-secondary" style="background-color: white; color: black; border-color: black;">No</a>
            </div>
        </div>
    </div>
</div>
@endsection