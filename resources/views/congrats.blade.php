<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/suarez_logo.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <div id="overlay" style="display:none">
        <div class="loader"></div>
    </div>
    <nav class="navbar navbar-light bg-light pb-0 pt-0">
        <div class="container" style="justify-content:left;margin-right:35%;">
            <a href="/">
                <img src="{{ asset('img/suarez_logo.png') }}" alt="suarez-seal" style="object-fit: contain;width:20rem;height:10rem;">
            </a>
            <div class="nav-text-margin">
                <h1 style="font-weight:900;border-bottom:1px solid black;">BARANGAY SUAREZ</h1>
                <h4>Iligan City, Philippines 9200</h4>
            </div>
        </div>
    </nav>
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="text-center">
            <h1><strong>Congratulation!</strong></h1>
            <h4>You have successfully scheduled an appointment on 
                <strong class="text-success" style="text-decoration: underline">
                    {{ Session::get('message') }}
                </strong>
            </h4>
            <span class="text-danger">Please take a screenshot</span>
        </div>
    </div>

    {{-- footer --}}
        <footer class="page-footer font-small bg-dark" style="margin-top:8rem">
            <div class="footer-copyright text-center py-3 text-white">© 2022 Copyright |
                <a href="/" class="text-white font-italic">suarez.gasa.tech</a>
            </div>
        </footer>
    {{-- footer end --}}

    {{-- script --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
    {{-- script end --}}
</body>
</html>