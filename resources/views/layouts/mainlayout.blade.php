<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Commerce | @yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @include('panels.css')

    @yield('page-css')
    <style>
        .flex {
            display: flex;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">

            </div>
        </div>
        @include('panels.header')

        <div class="flex">
            @include('panels.sidebar')

            @yield('page-contant')
        </div>
        @include('panels.footer')

        @include('panels.js')

        @yield('page-js')
    </div>

</body>

</html>
