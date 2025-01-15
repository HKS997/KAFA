@extends('ManageRegistration.Muip Admin.template')

@section('content')
    <div class="container mt-5">
        <h2>Select Year</h2>
        @php
            // Define an array of colors
            $colors = ['#FF5733', '#33FF57', '#5733FF', '#33FFFF', '#FF33FF'];
        @endphp

        @foreach($years as $key => $year)
            <a href="{{ route('report.StudentByYear', ['year' => $year]) }}" class="btn btn-year" style="background-color: {{ $colors[$key % count($colors)] }}">Tahun {{ $year }}</a>
        @endforeach
    </div>


    <style>
        .btn-year {
            display: inline-block;
            border-radius: 27px;
            margin: 10px; /* Adjust margin between buttons */
            padding: 40px 80px; /* Adjust padding to make the buttons larger */
            font-size: 28px; /* Adjust font size as needed */
            cursor: pointer;
            text-decoration: none;
            color: white;
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; /* Add black stroke around text */
        }
    </style>
@endsection
