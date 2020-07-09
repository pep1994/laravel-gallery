<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel - Gallery</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
        <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet" />
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
        <script src="{{ asset('js/lightbox.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
