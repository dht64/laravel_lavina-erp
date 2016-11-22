<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Print</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>

<body>
<div class="container card">
    @yield('content')
</div>

<div class="container">
    <button class="btn btn-primary" onClick="window.print()"><span class="glyphicon glyphicon-print" ></span> Print this page</button>
</div>

<script src="{{asset('js/libs.js')}}"></script>
@yield('scripts')

</body>
</html>