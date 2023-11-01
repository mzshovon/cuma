<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form for CUMA</title>

    <!-- Font Icon -->
    <link href="{{asset('/frontend/fonts/material-icon/css/material-design-iconic-font.min.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/vendor/nouislider/nouislider.min.css')}}" rel="stylesheet">

    <!-- Main css -->
    <link href="{{ asset('/frontend/css/style.css') }}" rel="stylesheet">
</head>
<body>

@yield('content')

<script src="{{asset('/frontend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/frontend/vendor/nouislider/nouislider.min.js')}}"></script>
<script src="{{asset('/frontend/vendor/wnumb/wNumb.js')}}"></script>
<script src="{{asset('/frontend/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('/frontend/vendor/jquery-validation/dist/additional-methods.min.js')}}"></script>
<script src="{{asset('/frontend/js/main.js')}}"></script>

</body>
</html>
