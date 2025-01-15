@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="container text-center mb-4">
                <h2 id=login>{{ __('Login') }}</h2>
            </div>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success d-flex justify-content-center" style="width: 600px;" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="d-flex justify-content-center align-items-center">
                <div class="d-flex justify-content-center" style="width: 600px;">
                    <form method="POST" action="{{ route('login') }}" style="width: 400px;">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus id="email">
                            <label for="email" class="fw-semibold">Email</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" id="password">
                            <label for="password">Password</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select @error('role') is-invalid @enderror" name="role" id="role"
                                aria-label="Floating label select example" required>
                                <option value="Teacher" {{ old('role') == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                                <option value="Parent" {{ old('role') == 'Parent' ? 'selected' : '' }}>Parent</option>
                                <option value="Kafa" {{ old('role') == 'Kafa' ? 'selected' : '' }}>KAFA Admin</option>
                                <option value="Muip" {{ old('role') == 'Muip' ? 'selected' : '' }}>MUIP Admin</option>
                            </select>
                            <label for="role">Role</label>
                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="col-md-6 d-flex flex-column align-items-center">
                                <button id="submit-button" type="submit" class="btn btn-warning my-4">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif

                                @if (Route::has('register'))
                                    <div class="container d-flex align-items-center" style="width: 400px;">
                                        <span class="no-account-text">No account yet?</span>
                                        <button type="button" onclick="window.location.href='{{ route('register') }}'"
                                            class="btn btn-light" id="custom-register-btn">
                                            Sign up now
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const dropdownItems = document.querySelectorAll('.dropdown-item');
            const dropdownButton = document.getElementById('dropdownMenuButton1');
            const roleInput = document.getElementById('role');

            dropdownItems.forEach(item => {
                item.addEventListener('click', function(event) {
                    event.preventDefault();
                    const value = this.getAttribute('data-value');
                    const text = this.textContent;

                    dropdownButton.textContent = text;
                    roleInput.value = value;
                });
            });
        });
    </script>
@endsection
