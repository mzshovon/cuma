<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CUMA</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{URL::to('/')}}/public/frontend/images/CUMA-Logo.png" rel="icon">
    <link href="{{URL::to('/')}}/public/frontend/images/CUMA-Logo.png" rel="apple-touch-icon">

    <!-- Font Icon -->
    <link href="{{URL::to('/')}}/public/frontend/fonts/material-icon/css/material-design-iconic-font.min.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/public/frontend/vendor/nouislider/nouislider.min.css" rel="stylesheet">

    <!-- Main css -->
    <link href="{{URL::to('/')}}/public/frontend/css/style.css" rel="stylesheet">
</head>
<body>

@yield('content')

<script src="{{URL::to('/')}}/public/frontend/vendor/jquery/jquery.min.js"></script>
<script src="{{URL::to('/')}}/public/frontend/vendor/nouislider/nouislider.min.js"></script>
<script src="{{URL::to('/')}}/public/frontend/vendor/wnumb/wNumb.js"></script>
<script src="{{URL::to('/')}}/public/frontend/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="{{URL::to('/')}}/public/frontend/vendor/jquery-validation/dist/additional-methods.min.js"></script>
<script src="{{URL::to('/')}}/public/frontend/js/main.js"></script>

</body>
</html>
