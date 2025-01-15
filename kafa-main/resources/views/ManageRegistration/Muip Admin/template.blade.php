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
<style>
    /* Custom styles to ensure the dropdown works */
    .position-sticky {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        z-index: 1020;
    }

    .dropdown-menu {
        position: static;
        float: none;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }

    .dropdown-toggle::after {
        display: none;
    }

    .dropdown-item {
        text-align: center;
    }
</style>

<body style="background-color: #26BBE1;">
    <!--Main Navigation-->
    <header>

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
                <a class="navbar-brand">
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
    <main style="margin-top: 70px;">
        <div class="container-fluid pt-4">
            <div class="row">
                <!-- Sidebar column -->
                <div class="col-lg-2">
                    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
                        <div class="position-sticky">
                            <div class="list-group list-group-flush mx-3 mt-2 custom-pt">

                                <a class="nav-link d-flex justify-content-center align-items-center"
                                    href="{{ route('profile.edit') }}" id="navbarDropdownMenuLink" role="button"
                                    aria-expanded="false">
                                    @if (Auth::user()->profile_picture)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                            class="rounded-circle" height="160" width="160" alt="Avatar" loading="lazy" />
                                    @else
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp"
                                            class="rounded-circle" height="130" alt="Avatar" loading="lazy" />
                                    @endif
                                </a>


                                <a href="#"
                                    class="list-group-item list-group-item-action py-2 ripple text-center justify-content-between mt-5"
                                    aria-current="true">
                                    <span>Home</span>
                                </a>
                                <a href="{{ route('muip.showSearchForm') }}"
                                    class="list-group-item list-group-item-action py-2 ripple text-center active justify-content-between ">
                                    <span>Student Result</span>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action py-2 ripple text-center ">
                                    <span>Timetable</span></a>

                                <!-- Dropdown Menu -->
                                <div class="dropdown mt-2">
                                    <a class="list-group-item list-group-item-action py-2 ripple text-center dropdown-toggle"
                                        href="#" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false">
                                        Report
                                    </a>
                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item"
                                            href="{{ route('report.ViewFinishActivityList') }}">Activity</a>
                                        <a class="dropdown-item"
                                            href="{{ route('report.AcademicYearOption') }}">Academic</a>
                                    </div>
                                </div>
                                <!-- End Dropdown Menu -->

                                <a href="#"
                                    class="list-group-item list-group-item-action py-2 ripple text-center ">
                                    <span>Fee</span>
                                </a>
                                <a href="{{route('MUIPadmin.activities.search')}}" class="list-group-item list-group-item-action py-2 ripple text-center ">
                                    <span>Activity</span></a>
                            </div>
                        </div>
                    </nav>
                </div>
                <!-- Main content column -->
                <div class="col-lg-6">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--Main layout-->
    {{-- End Content --}}
    <!-- Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('/') }}assets/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Initialize Bootstrap dropdowns
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();
        });
    </script>
</body>

</html>
