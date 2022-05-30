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
    <div class="container mt-3">
        <div class="alert alert-warning text-center">
            <strong>
                Please make sure to settle your 
                "<span id="open_modal" style="text-decoration:underline;cursor:pointer;">ZONE LIABILITIES</span>" 
                before your scheduled appointment!
            </strong>
        </div>
        <h4>Choose date:</h4>
        <div class="row">
            <div class="col-sm-4">
                <div id="datepicker"></div>
            </div>
            <div class="col-sm-6">
                <div id="first-step-available" style="display:none;">
                    <form id="next-step-form">
                        <label>Time:</label>
                        <select name="time" class="form-control" required id="select-time">
                            <option disabled selected value="">-- Select Time --</option>
                            <option value="am" id="am" disabled>AM - 8:00am to 12:00pm</option>
                            <option value="pm" id="pm" disabled>PM - 1:00pm to 5:00pm</option>
                        </select>
                        <label class="mt-2">Document Type:</label>
                        <select name="document_type" class="form-control" required id="select-document-type">
                            <option disabled selected value="">-- Select Type --</option>
                            <option value="brgy_cert">Barangay Certificate</option>
                            <option value="indigency">Certificate of Indigency</option>
                        </select>
                        <label class="mt-2">Input Name:</label>
                        <div class="d-flex">
                            <input type="text" class="form-control" name="last_name" placeholder="Family Name" required id="last_name">
                            <input type="text" class="form-control" name="first_name" placeholder="Given Name" required id="first_name">
                            <input type="text" class="form-control" name="middle_name" placeholder="Middle Name" id="middle_name">
                        </div>
                        <button class="btn btn-primary mt-2" id="next-step-btn" type="submit">Validate Name</button>
                    </form>
                </div>
                <div id="first-step-not-available" style="display:none;">
                    <div class="alert alert-danger text-center">
                        <strong>
                            NO AVAILABLE TIME FOR THIS DATE!
                            <br>
                            Please choose a different date
                        </strong>
                    </div>
                </div>
            </div>
        </div>
        <div id="warning-message-container" class="mt-3" style="display:none;">
            <div class="alert alert-info text-center">
                <strong id="warning-message"></strong>
            </div>
        </div>
        <div id="final-step-available" style="display:none">
            <hr>
            <h4 class="mt-3">Fill all information:</h4>
            <div class="row">
                <div class="col">
                    <label>Zone:</label>
                    <input type="text" class="form-control" value="" readonly id="zone-name">
                </div>
                <div class="col">
                    <label>Age:</label>
                    <input type="text" class="form-control" value="" readonly id="age">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label>Phone Number:</label>
                    <input type="text" class="form-control" value="" id="phone_number" form="appointment-form" name="phone_number">
                </div>
                <div class="col">
                    <label>Email:</label>
                    <input type="email" class="form-control" value="" id="email-address" form="appointment-form" name="email_address">
                </div>
            </div>
            <label class="mt-3">Purpose:</label>
            <input type="text" class="form-control" value="" form="appointment-form" required name="purpose">
            <button class="btn btn-primary btn-block mt-3" type="submit" form="appointment-form">Submit</button>
        </div>
        <div id="final-step-not-available" class="mt-3" style="display:none;">
            <div class="alert alert-danger text-center">
                <strong id="error-message"></strong>
            </div>
        </div>
    </div>
    
    {{-- hidden form --}}
        <form action="{{ route('set-appointment') }}" method="POST" id="appointment-form">
            @csrf
            <input type="hidden" id="date-value" name="date">
            <input type="hidden" id="resident-id-value" name="resident_id">
            <input type="hidden" id="time-value" name="time">
            <input type="hidden" id="document-type-value" name="document_type">
            <input type="hidden" id="appointment-id-value" name="appointment_id">
        </form>
    {{-- hidden form end --}}

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
        <script>
            $('#open_modal').click(function(e) {
                alert('Please visit your zone president to clear your zone liabilities!')
            })
            $( function() {
                $( "#datepicker").datepicker({
                    minDate: 0,
                    maxDate: 20,
                    beforeShowDay: function(date) {
                        var day = date.getDay()
                        return [(day != 0 && day != 6),  '']
                    }
                });
            });
            $('#datepicker').change(function(e) {
                var val = $(this).val()
                $('#date-value').val(val)
                $('#select-time').val('')
                $('#time-value').val('')
                $('#select-document-type').val('')
                $('#document-type-value').val('')

                $('#overlay').show();
                $('#first-step-available').hide();
                $('#first-step-not-available').hide();
                $('#final-step-available').hide()
                $('#warning-message-container').hide()
                $('#am').attr('disabled', true); 
                $('#pm').attr('disabled', true); 

                $.ajax({
                    // "_token": "{{ csrf_token() }}",
                    type: 'get',
                    url: '/datepicker',
                    data: {'data': val},
                    success: function (result) {
                        $('#overlay').hide();
                        if (result.first_step) {
                            $('#first-step-available').show();
                        } else {
                            $('#first-step-not-available').show();
                        }

                        if (result.am) {
                            $('#am').attr('disabled', false); 
                        }

                        if (result.pm) {
                            $('#pm').attr('disabled', false); 
                        }
                    }
                })
            })

            $('#next-step-form').submit(function(e) {
                e.preventDefault()
                $('#overlay').show()
                $('#final-step-available').hide()
                $('#final-step-not-available').hide()
                $('#warning-message-container').hide()
                $('#error-message').html('')
                $('#zone-name').val('')
                $('#age').val('')
                $('#resident-id-value').val('')
                $('#appointment-id-value').val('')
                
                var last_name = $('#last_name').val()
                var first_name = $('#first_name').val()
                var middle_name = $('#middle_name').val()
                var date = $('#date-value').val()
                
                $.ajax({
                    // "_token": "{{ csrf_token() }}",
                    type: 'get',
                    url: '/resident-check',
                    data: {'last_name': last_name, 'first_name': first_name, 'middle_name': middle_name, 'date': date},
                    success: function (result) {
                        $('#overlay').hide();
                        if (result.error_message !== null) {
                            $('#final-step-not-available').show()
                            $('#error-message').html(result.error_message)
                        } else {
                            $('#final-step-available').show();
                            $('#zone-name').val(result.resident.zone.name)
                            $('#age').val(result.resident.age)
                            $('#resident-id-value').val(result.resident.id)
                            console.log(result.appointment)
                            $('#appointment-id-value').val(result.appointment.id)
                        }

                        if (result.warning_message !== null) {
                            $('#warning-message-container').show()
                            $('#warning-message').html(result.warning_message)
                        }
                    }
                })
            })

            $('#select-time').change(function(e) {
                $('#time-value').val($(this).val())
            })
            $('#select-document-type').change(function(e) {
                $('#document-type-value').val($(this).val())
            })

            $('#appointment-form').submit(function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to set this appointment?') == true) {
                    this.submit()
                }
            })
        </script>
    {{-- script end --}}
</body>
</html>