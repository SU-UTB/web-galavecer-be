<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<div class="min-h-screen bg-gray-100">

    <x-navbar></x-navbar>
    <!-- Page Content -->
    <main>
        <div class="card">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="d-flex p-5">
                            <div>
                                <p>Nominated total: {{ $nominatedTotal }}</p>
                                <br>
                                <br>
                                <p>Nominated FT: {{ $nominatedFT }}</p>
                                <p>Nominated FAME: {{ $nominatedFAME }}</p>
                                <p>Nominated FMK: {{ $nominatedFMK }}</p>
                                <p>Nominated FAI: {{ $nominatedFAI }}</p>
                                <p>Nominated FHS: {{ $nominatedFHS }}</p>
                                <p>Nominated FLKR: {{ $nominatedFLKR }}</p>
                                <br>
                                <br>
                                <p>Most voted:</p>
                                @foreach($mostVoted as $mv)
                                    <p>{{ $mv['name'] . ' '. $mv['count']}}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>


</body>


</html>
