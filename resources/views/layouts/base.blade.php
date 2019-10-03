<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Weibo App') - HAKEER 入门教程</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
</head>

<body>
    @include('layouts._header')
    <div class="container">
        @include('shared._alter')
        @yield('content')
        @include('layouts._footer')

    </div>

</body>

</html>
