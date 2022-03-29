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
            <img src="{{ asset('img/suarez_logo.png') }}" alt="suarez-seal" style="object-fit: contain;width:20rem;height:10rem;">
            <div class="nav-text-margin">
                <h1 style="font-weight:900;border-bottom:1px solid black;">BARANGGAY SUAREZ</h1>
                <h4>Iligan City, Philippines 9200</h4>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="alert alert-warning text-center">
            <strong>
                Please make sure to settle your 
                "<span id="open_modal" style="text-decoration:underline;cursor:pointer;">ZONE LIABILITIES</span>" 
                before your scheduled appointment!
            </strong>
        </div>
        <h4>Schedule Appointment:</h4>
        <div class="row">
            <div class="col">
                <div id="datepicker"></div>
            </div>
            <div class="col">
                
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
    <script>
        $('#open_modal').click(function(e) {
            alert('Please visit your zone president to clear your zone liabilities!')
        })
        $( function() {
            $( "#datepicker").datepicker({
                minDate: 0,
                maxDate: 20,
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    return [(day != 0 && day != 6),  ''];
                }
            });
        });
        $('#datepicker').change(function(e) {
            $('#overlay').show().delay(1000).fadeOut();
        })
    </script>
</body>
</html>