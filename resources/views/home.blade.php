<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Free fake REST API for testing and prototyping."/>
    <meta property="og:image" content="{{ url("assets/img/restapi.png") }}"/>
    <title>JSONFaker - Free Fake REST API</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Bootstrap CSS / Color Scheme -->
    <link rel="stylesheet" href="{{ url("assets/css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ url("assets/css/custom.css") }}">

    <!-- JSONFaker favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url("assets/img/JSONFaker-favicon.ico") }}">
</head>
<body>

    <!--Header components-->
    @include('components.header')

    <!--Section components-->
    @include('components.section')

    <!--Footer components-->
    @include('components.footer')


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.7.3/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.21.0/prism.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.21.0/plugins/line-numbers/prism-line-numbers.min.js"></script>
<script src="{{ url("assets/js/scripts.js") }}"></script>
@stack('script')
</body>
</html>
