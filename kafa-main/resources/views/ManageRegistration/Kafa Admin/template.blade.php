<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="{{ asset('/') }}assets/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/') }}assets/dist/css/adminstyle.css">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}">

</head>

<body style="background-color: #4299FE;">
    {{-- Navbar --}}
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-2 custom-pt">

                    <a class="nav-link d-flex justify-content-center align-items-center" href="#"
                        id="navbarDropdownMenuLink" role="button" aria-expanded="false">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle"
                            height="130" alt="Avatar" loading="lazy" />
                    </a>

                    <a href="#"
                        class="list-group-item list-group-item-action py-2 ripple text-center justify-content-between mt-5"
                        aria-current="true">
                        <span>Home</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple text-center ">
                        <span>Student Result</span>
                    </a>
                    <a href="{{ route('manage.timetable.list') }}" class="list-group-item list-group-item-action py-2 ripple text-center ">
                        <span>Timetable</span>
                    </a>
                    <a href="{{ route('report.ViewActivityList')}}" class="list-group-item list-group-item-action py-2 ripple text-center ">
                        <span>Report</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple text-center ">
                        <span>Fee</span>
                    </a>
                    <a href="{{route('KAFAadmin.activities.search')}}" class="list-group-item list-group-item-action py-2 ripple text-center ">
                        <span>Activity</span></a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/logo.png') }}" height="45" alt="MDB Logo" loading="lazy" />
                </a>


                <!-- Right links -->
                <ul class="navbar-nav ms-auto d-flex flex-row">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-warning"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container-fluid pt-4">
            <div class="row">
                <!-- Sidebar column -->
                <div class="col-lg-2">
                    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
                        <div class="position-sticky">
                            <div class="list-group list-group-flush mx-3 mt-2 custom-pt">
                                <a class="nav-link d-flex justify-content-center align-items-center" href="#"
                                    id="navbarDropdownMenuLink" role="button" aria-expanded="false">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp"
                                        class="rounded-circle" height="130" alt="Avatar" loading="lazy" />
                                </a>

                                <a href="#"
                                    class="list-group-item list-group-item-action py-2 ripple text-center justify-content-between mt-5"
                                    aria-current="true">
                                    <span>Home</span>
                                </a>
                                <a href="{{ route('kafa.showSearchForm') }}"
                                    class="list-group-item list-group-item-action py-2 ripple text-center active justify-content-between ">
                                    <span>Student Result</span>
                                <a href="{{ route('profile.ParentTeacherList') }}"
                                    class="list-group-item list-group-item-action py-2 ripple text-center ">
                                    <span>User Profile</span></a>
                                </a>
                                <a href="{{ route('manage.timetable.list') }}"
                                    class="list-group-item list-group-item-action py-2 ripple text-center ">
                                    <span>Timetable</span></a>
                                <a href="{{ route('report.ViewActivityList') }}"
                                    class="list-group-item list-group-item-action py-2 ripple text-center ">
                                    <span>Report</span></a>
                                <a href="#"
                                    class="list-group-item list-group-item-action py-2 ripple text-center ">
                                    <span>Fee</span>
                                </a>
                                <a href="{{route('KAFAadmin.activities.search')}}"
                                    class="list-group-item list-group-item-action py-2 ripple text-center ">
                                    <span>Activity</span></a>
                            </div>
                        </div>
                    </nav>
                </div>
                <!-- Main content column -->
                <div class="col-lg-6">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
    <!--Main layout-->

    <script src="{{ asset('/') }}assets/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
