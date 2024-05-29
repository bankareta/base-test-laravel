<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="shortcut icon" type="image/png" href="{{ asset('img/icon.png') }}">

    {{-- Style --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('semantic/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/app-v2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nusa.css') }}">

    <style type="text/css">
        html, body{
            min-height: 100%;
        }
        body {
            background: url({{ asset('img/backgrounds/bg-login.jpg') }});
            background-size: cover;
            background-position: bottom;
            position: relative;
            display: flex;
        }
        .ui.grid {
            margin-top: 0;
            margin-bottom: 0;
            margin-left: 0;
            margin-right: 0;
        }
        body:before {
          content: "";
          position: absolute;
          top: 0; left: 0;
          width: 100%; height: 100%;
          background-color: #333;
          opacity: .7;
        }
        body > .grid {
            height: 100%;
            width: 100%;
        }
        /* .image {
            margin-top: -100px;
        } */
        .column.register {
            max-width: 450px;
            z-index: 2;
        }
        .column.full {
            max-width: 100%;
            z-index: 2;
        }
        h2.ui.red.image.header {
            width: 450px;
        }
        .overlay{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            background-color: rgba(0,0,0,0.1); /*dim the background*/
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    @yield('content')

    <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('plugins/jQuery/jquery.form.min.js') }}"></script>
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('semantic/semantic.min.js') }}"></script>
    <script type="text/javascript">
        $(document)
        .ready(function($) {
            $('.dimmable.special.cards .image').dimmer({
              on: 'hover'
            });
            $('.ui.form')
            .form({
                fields: {
                    username: {
                        identifier  : 'text',
                        rules: [
                        {
                            type   : 'empty',
                            prompt : 'Please enter your username'
                        }
                        ]
                    },
                    password: {
                        identifier  : 'password',
                        rules: [
                        {
                            type   : 'empty',
                            prompt : 'Please enter your password'
                        }
                        ]
                    }
                }
            });
            $('.message .close')
              .on('click', function() {
                $(this)
                  .closest('.message')
                  .transition('fade')
                ;
              })
            ;
            $('.ui.dropdown').dropdown({
                onChange: function(value) {
                    var target = $(this).dropdown();
                    if (value!="") {
                        target
                            .find('.dropdown.icon')
                            .removeClass('dropdown')
                            .addClass('delete')
                            .on('click', function() {
                                target.dropdown('clear');
                                $(this).removeClass('delete').addClass('dropdown');
                                return false;
                            });
                    }
                }
            });
        });
    </script>
    @yield('scripts')
    @include('scripts.front')
</body>
</html>
