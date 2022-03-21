<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}

                </div>
            </header>

            <!-- Page Content -->
            <main>
                <x-session-message status="{{ Session::get('status') }}"></x-session-message>
                <div style="display:none;" id="success_delete">
                    <x-session-message status="Deleted successfully!"></x-session-message>
                </div>
                <div class="flex justify-center mt-4">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                </div>
                {{ $slot }}
            </main>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })

                $('#session-message').click(function(e) {
                    $(this).hide();
                })

                $('.delete_btn').click(function(e) {
                    if (confirm('Are you sure you want to delete this record?') == true) {
                        $(this).closest('tr').hide();
                        $('#success_delete').show();
                        $.ajax({
                            "_token": "{{ csrf_token() }}",
                            url: $(this).data('url'),
                            type: 'DELETE',
                            success: function (result) {
                            }
                        })
                    }
                })
            })
        </script>
        {{ $script ?? '' }}
    </body>
</html>
