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

            <br>
            <div class="mx-auto" style="width: 250px;">
                <form name="search-reservation-form" id="search-reservation-form" method="POST"
                    action="{{ route('search-nominations') }}">
                    @csrf

                    <input type="text" class="form-control" id="search" name="search"
                        placeholder="Search by nominee..." value="{{ $search }}" onchange="this.form.submit();">
                </form>
            </div>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Recommendator</th>
                        <th scope="col">Faculty of nominee</th>
                        <th scope="col">Category</th>
                        <th scope="col">Nominee</th>
                        <th scope="col">Nominee Email</th>
                        <th scope="col">Achievements</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nominations as $nomination)
                        <tr>
                            <th scope="row">{{ $nomination['id'] }}</th>
                            <td>{{ $nomination['recommendator_first_name'] . ' ' . $nomination['recommendator_last_name'] }}
                            </td>
                            <td>{{ $nomination['faculty']['abbrev'] }}</td>
                            <td>{{ $nomination['category']['name'] }}</td>
                            <td>{{ $nomination['nominee_first_name'] . ' ' . $nomination['nominee_last_name'] }}</td>
                            <td>{{ $nomination['nominee_email'] }}</td>
                            <td>{{ $nomination['achievements'] }}</td>

                            <td>
                                <button type="submit" class="btn btn-orange">
                                    <a href="{{ route('deleteNomination', $nomination['id']) }}">Delete</a></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </main>
    </div>


</body>


</html>

<script>
    function onSearch(params) {
        console.log(params);
    }
</script>
