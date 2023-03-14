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
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<div class="min-h-screen bg-gray-100">


    <!-- Page Content -->
    <main>

        <div class="container mt-4">

            <div class="card">
                <div class="card-header text-center font-weight-bold">
                    Login
                </div>
                <div class="card-body">

                    <form name="add-blog-post-form" id="add-blog-post-form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mt-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="kaja@bourak.com">
                        </div>
                        <div class="form-group mt-2">
                            <label for="tel" class="form-label">Telefon</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="555 252 222">
                        </div>


                        <br>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-blue">Log in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>


</body>

</html>
