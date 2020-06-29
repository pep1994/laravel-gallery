<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel - Gallery</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        @include('components.header')
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
        @yield('script')
       
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
