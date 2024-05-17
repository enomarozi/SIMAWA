<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.title-meta')
    @include('layouts.head')
</head>

@section('body')
    
    <style type="text/css">
        body{
            margin-top: 200px;
        }
        .authentication-bg{
            background-color: #e9ecef;
        }
    </style>
    <body class="authentication-bg">
        @show
        @yield('content')
        @include('layouts.vendor-scripts')
    </body>

</html>
