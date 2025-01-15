@extends('ManageTimetable.KAFAAdmin.KafaTemplate')

@section('kafapunya')
<div class="container">
    <div class="card" style="margin-left: 20%; width: 60%;">
      <div class="card-header">
        CLASS TIMETABLE LIST
      </div>
      <div class="card-body d-flex justify-content-center align-items-center">
        <div style="width: 100%;">
          <div class="d-flex justify-content-end mb-3">
            <form method="GET" action="{{ route('manage.timetable.list') }}" class="mb-3">
              <div class="input-group">
                  <input type="text" name="search" class="form-control" placeholder="Search by Class Name">
                  <div class="input-group-append">
                      <button type="submit" class="btn btn-outline-secondary">Search</button>
                  </div>
              </div>
            </form>
          </div>
          
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('manage.timetable.list.create') }}">
                <button class="btn btn-primary bg-dark mr-2" style="margin-right: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </button>
                </a>
                <a href="{{ route('manage.timetable.list.request') }}">
                  <button class="btn bg-dark" style="color: white;">Request</button>
              </a>
            </div>
          <table class="table" style="width: 100%; border-collapse: collapse;">
            <thead class="thead-dark" style="background-color: #343a40; color: white;">
              <tr>
                <th scope="col" style="padding: 8px; border: 1px solid #ddd;">No</th>
                <th scope="col" style="padding: 8px; border: 1px solid #ddd;">Class</th>
                <th scope="col" style="padding: 8px; border: 1px solid #ddd;">Last Approved</th>
                <th scope="col" style="padding: 8px; border: 1px solid #ddd;">Year</th>
                <th scope="col" style="padding: 8px; border: 1px solid #ddd;">Operation</th>
              </tr>
            </thead>
            <tbody>
              @foreach($timetables as $timetable)
                <tr style="background-color: {{ $loop->even ? '#f2f2f2' : 'white' }};">
                    <th scope="row" style="padding: 8px; border: 1px solid #ddd;">{{ $loop->iteration }}</th>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $timetable->timetable_classname }}</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $timetable->updated_at->format('Y-m-d') }}</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $timetable->timetable_year }}</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">
                  <a href="{{ route('manage.timetable.list.show', $timetable->id) }}" style="display: inline-block; width: 24px; height: 24px; margin-right: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                      <path d="M15.5 12a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"></path>
                      <path d="M12 3.5c3.432 0 6.124 1.534 8.054 3.241 1.926 1.703 3.132 3.61 3.616 4.46a1.6 1.6 0 0 1 0 1.598c-.484.85-1.69 2.757-3.616 4.461-1.929 1.706-4.622 3.24-8.054 3.24-3.432 0-6.124-1.534-8.054-3.24C2.02 15.558.814 13.65.33 12.8a1.6 1.6 0 0 1 0-1.598c.484-.85 1.69-2.757 3.616-4.462C5.875 5.034 8.568 3.5 12 3.5ZM1.633 11.945a.115.115 0 0 0-.017.055c.001.02.006.039.017.056.441.774 1.551 2.527 3.307 4.08C6.691 17.685 9.045 19 12 19c2.955 0 5.31-1.315 7.06-2.864 1.756-1.553 2.866-3.306 3.307-4.08a.111.111 0 0 0 .017-.056.111.111 0 0 0-.017-.056c-.441-.773-1.551-2.527-3.307-4.08C17.309 6.315 14.955 5 12 5 9.045 5 6.69 6.314 4.94 7.865c-1.756 1.552-2.866 3.306-3.307 4.08Z"></path>
                    </svg>
                  </a>
                  <a href="{{ route('manage.timetable.list.edit', $timetable->id) }}" style="display: inline-block; width: 24px; height: 24px; margin-right: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path d="M17.263 2.177a1.75 1.75 0 0 1 2.474 0l2.586 2.586a1.75 1.75 0 0 1 0 2.474L19.53 10.03l-.012.013L8.69 20.378a1.753 1.753 0 0 1-.699.409l-5.523 1.68a.748.748 0 0 1-.747-.188.748.748 0 0 1-.188-.747l1.673-5.5a1.75 1.75 0 0 1 .466-.756L14.476 4.963ZM4.708 16.361a.26.26 0 0 0-.067.108l-1.264 4.154 4.177-1.271a.253.253 0 0 0 .1-.059l10.273-9.806-2.94-2.939-10.279 9.813ZM19 8.44l2.263-2.262a.25.25 0 0 0 0-.354l-2.586-2.586a.25.25 0 0 0-.354 0L16.061 5.5Z"></path>
                    </svg>
                  </a>
                  <a href="{{ route('manage.timetable.list.confirm', $timetable->id) }}" style="display: inline-block; width: 24px; height: 24px; margin-right: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 16 16"><g fill="black"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/><path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/></g></svg>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection