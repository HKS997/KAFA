@extends('ManageRegistration.Muip Admin.template')

@section('content')
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- New profile picture -->
        <div class="mb-3">
            <label for="newProfilePicture" class="form-label">Upload New Profile Picture:</label>
            <input type="file" class="form-control" id="newProfilePicture" name="newProfilePicture">
        </div>

        <!-- Current profile picture -->
        <div class="mb-3">
            <label for="currentProfilePicture" class="form-label">Current Profile Picture:</label>
            <img src="{{ asset('storage/' . $user->profile_picture) }}" class="img-thumbnail" width="150px" height="150px"
                alt="Avatar" loading="lazy" />
        </div>

        <!-- Edit user data -->
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>
        <!-- Add more editable fields for user data as needed -->

        <!-- Edit muip_admin data -->
        <div class="mb-3">
            <label for="gender" class="form-label">Gender:</label>
            <select class="form-select" id="gender" name="gender">
                <option value="">Select Gender</option>
                <option value="Male" {{ $muipAdmin && $muipAdmin->gender == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $muipAdmin && $muipAdmin->gender == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <!-- Edit muip_admin address -->
        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $muipAdmin ? $muipAdmin->address : '' }}">
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
@endsection
