<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    {{-- <meta property="og:image" content="{{ asset('img/asset-new/logo-long-white.png') }}"> --}}
    <meta name="twitter:title" content="" />
	<meta name="twitter:description" content="" />

    <!-- Site Properties -->
    <title>{{ config('app.longname') }}</title>
    <link rel="shortcut icon" type="image/png" href="https://www.floweradvisor.com.ph/favicon.ico">

    <link rel="stylesheet" type="text/css" href="{{ asset('semantic/semantic.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert2.min.css') }}">

    <style type="text/css">
        html, body{
            min-height: 100%;
        }
        body {
            background: url({{ asset('img/asset-new/bg-image.jpg') }});
            background-size: cover;
            background-position: bottom;
            position: flex;
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
        .image {
            margin-top: -100px;
        }
        .column {
            max-width: 450px;
            z-index: 2;
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
    <script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('semantic/semantic.min.js') }}"></script>
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function($) {
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
            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");
            var trident = ua.indexOf('Trident/'); //IE 11
            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))  // If Internet Explorer, return version number
            {
                var rv = -1; // Return value assumes failure.
                if (navigator.appName == 'Microsoft Internet Explorer'){
                    var ua = navigator.userAgent,
                        re  = new RegExp("MSIE ([0-9]{1,}[\\.0-9]{0,})");

                    if (re.exec(ua) !== null){
                        rv = parseFloat( RegExp.$1 );
                    }
                }
                else if(navigator.appName == "Netscape"){                       
                if(navigator.appVersion.indexOf('Trident') === -1) rv = 12;
                    else rv = 11;
                }       
                if((parseInt(rv) < 12)){
                    $('#showerrorie').css('display','');
                    $('#showlogin').css('display','none');
                }else{
                    $('#showerrorie').css('display','none');
                }
            }else{
                $('#showerrorie').css('display','none');
            }
        });
    </script>
</body>
</html>
