<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Timetable Teacher</title>
    <link href="{{ asset('/') }}assets/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/') }}assets/dist/css/parent.css">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/') }}assets/dist/css/timetable.css">
</head>

<body style="background-color: #4299FE;">
    {{-- Navbar --}}
    <!--Main Navigation-->
    <header>

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid d-flex align-items-center justify-content-between">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/logo.png') }}" height="45" alt="MDB Logo" loading="lazy" />
                </a>

                <!-- Centered navigation -->
                <div class="d-flex justify-content-center flex-grow-1">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-profile-tab" href="{{ route('teacher.dashboard') }}">Home</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab"
                                aria-controls="pills-profile" aria-selected="false">Activity</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab"
                                aria-controls="pills-contact" aria-selected="false">Result</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <div class="dropdown">
                                <button class="dropbtn">Timetable</button>
                                <div class="dropdown-content">
                                    <a href="{{ route('manage.timetable.list', ['year' => 1]) }}">Year 1</a>
                                    <a href="{{ route('manage.timetable.list', ['year' => 2]) }}">Year 2</a>
                                    <a href="{{ route('manage.timetable.list', ['year' => 3]) }}">Year 3</a>
                                    <a href="{{ route('manage.timetable.list', ['year' => 4]) }}">Year 4</a>
                                    <a href="{{ route('manage.timetable.list', ['year' => 5]) }}">Year 5</a>
                                </div>
                              </div>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab"
                                aria-controls="pills-contact" aria-selected="false">Report</button>
                        </li>
                    </ul>
                </div>

                <!-- Right links -->
                <div class="d-flex align-items-center">
                    <form method="POST" action="{{ route('logout') }}" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-warning"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4"></div>
    </main>
    <!--Main layout-->

    {{-- Content --}}
    <div class="mt-2 ">
        <div class="container">
            @yield('contentTTimetable')
        </div>
    </div>
    {{-- End Content --}}


    <script src="{{ asset('/') }}assets/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
