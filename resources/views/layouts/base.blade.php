<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/png" href="https://www.floweradvisor.com.ph/favicon.ico">
    {{-- Style --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('semantic/semantic.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-v2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nusa.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/highchart/css/highcharts.css') }}">
    <style type="text/css">
    .ui.file.input input[type="file"] {
        display: none;
    }
    .ui.button>.ui.floated.label {
        position: absolute;
        top: 15px;
        right: -10px;
    }
    .table tr th{
        white-space: nowrap;
    }
    .notif.item:hover .message {
        background-color: rgba(61, 177, 227, 0.14) !important;
    }
    .ui.class.dropdown {
        display: block;
        width: 100%;
        min-width: 0em;
    }
    table.dataTable.table thead th.sorting:after,
    table.dataTable.table thead td.sorting:after {
        color: black !important;
    }
</style>
@yield('css')
@yield('styles')
</head>
<body id="app">
    <header>
        @include('partials.header')
    </header>

    <div class="ui sidebar visible vertical menu">
        {{-- style="background-color: #222d32 !important;" --}}
        <div class="ui fluid accordion" id="sideMenu">
            @include('partials.menu', ['items' => $mainMenu->roots()])
        </div>
    </div>
    <div id="cover">
        <div class="ui active inverted dimmer">
            <div class="ui text loader">Loading</div>
        </div>
    </div>

    <div class="pusher content shown">
        <message></message>
        <div class="main ui fluid container" id="main-container">
            <div id="showerrorie">
                <div class="ui negative message">
                    We’ll stop supporting this browser. For the best experience please update your browser to <br><a href="#">Chrome, Mozila Firefox, Microsoft Edge Or Opera</a>.
                </div>
            </div>
            @yield('content')
        </div>

        <footer class="ui vertical footer fixed segment" style="background-color: black !important;">
            <div class="ui grid blue">
                <div class="ui sixteen wide column center aligned">
                    <a href="https://www.floweradvisor.com.ph" target="_blank">
                        <span><i>Copyright &copy; 2024 All Rights Reserved</i></span>
                    </a>
                </div>
            </div>
        </footer>
    </div>

    {{-- @include('partials.footer') --}}

    {{-- form modals --}}
    @yield('modals')
    <div class="ui mini modal">
        <div class="ui inverted loading dimmer">
            <div class="ui text loader">Loading</div>
        </div>
    </div>

    <div class="ui tiny modal">
        <div class="ui inverted loading dimmer">
            <div class="ui text loader">Loading</div>
        </div>
    </div>

    <div class="ui small modal">
        <div class="ui inverted loading dimmer">
            <div class="ui text loader">Loading</div>
        </div>
    </div>

    <div class="ui large modal">
        <div class="ui inverted loading dimmer">
            <div class="ui text loader">Loading</div>
        </div>
    </div>
    <div class="ui fullscreen modal">
        <div class="ui inverted loading dimmer">
            <div class="ui text loader">Loading</div>
        </div>
    </div>

    {{-- Script --}}
    <script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        ]) !!}
    </script>
    <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('plugins/jQuery/jquery.form.min.js') }}"></script>
    <script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('semantic/semantic.min.js') }}"></script>
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>

    <script src="{{ asset('js/app-v2.js') }}"></script>
    <script src="{{ asset('plugins/highchart/highcharts.js') }}"></script>
    <script src="{{ asset('plugins/highchart/modules/exporting.js') }}"></script>
    <script src="{{ asset('plugins/highchart/modules/export-data.js') }}"></script>
    <script src="{{ asset('plugins/highchart/modules/accessibility.js') }}"></script>
    @yield('js')

    <script type="text/javascript">
    function deadlineMail(){
       $.ajax({
        url: '{{ url("jobs/deadline") }}',
        type: 'GET',
        success: function(resp){
        },
        error : function(resp){
        }
    });
    }

    function sidebaractive() {
      $('.sidebarchildmenumfs.active').parents('.ui.content:first').prev().addClass('active')
    };

     var month = ['January','February','March','April','May','June','July','August','September','October','November','December'];


    function closeSidebar() {
        $('a[href="http://supreme-hse.me/home"]').attr('href', '#');

        if($('.pusher').hasClass('first-shown')) { $('.pusher').removeClass('first-shown') }

        if($('.ui.sidebar').sidebar('is hidden')){
            // alert('is no')
            $('.pusher').removeClass('shown')
            $('.ui.sidebar')
            .sidebar({
                dimPage: false,
                closable: false
            })
            .sidebar('hide');
        }else{
            // alert('no u')
            $('.pusher').removeClass('shown')
            $('.ui.sidebar')
            .sidebar({
                dimPage: false,
                closable: false
            })
            .sidebar('hide');
        }
    }

    $(document).on('click','.ampasClick',function(e){
        e.preventDefault();
        var url = $(this).data('href');
        formData = {'_token' : '{{ csrf_token() }}',"id":$(this).data('id'),"modul":$(this).data('modul'), "url" : url};
        $.ajax({
            url: '{{ url("jobs/post-notif") }}',
            type: 'POST',
            dataType: 'json',
            data : formData,
            success: function(resp){
                if(resp)
                {
                    location.href = url;
                }
            },
            error : function(resp){
            }

        });
    });

    $(document).ready(function() {
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
        sidebaractive();
        if($(window).width() < 700){
            closeSidebar();
        }
        setInterval(
          deadlineMail,
          60 * 300000
        );

        $('.ui.divider.dividersidebar').each(function (index, element) {
            var group = $(element).data('group');
            var exist = $('.sidebarmenumfs[data-group="'+group+'"]').length;
            if(exist < 1)
            {
                element.style.display = "none";
            }
        })

        $('.ui.title.sidebarmenumfs').on('click', function () {
            $('.ui.divider.dividersidebarchild').each(function (index, element) {
                var group = $(element).data('childgroup');
                var exist = $(element).parents('.ui.content').find('a[data-childgroup="'+group+'"]').length;
                var elem = element;
                if(exist < 1)
                {
                    setTimeout(function (e) {
                        $(elem).attr('style', 'display:none !important;');
                    }, 500)
                }
            })
        })

        $('.ui.divider.dividersidebarchild').each(function (index, element) {
            var group = $(element).data('childgroup');
            var exist = $(element).parents('.ui.content').find('a[data-childgroup="'+group+'"]').length;
            var elem = element;
            if(exist < 1)
            {
                setTimeout(function (e) {
                    $(elem).attr('style', 'display:none !important;');
                }, 500)
            }
        })
        $('.url.example .ui.embed').embed();
        $('.dimmable.special.cards .image').dimmer({
         on: 'hover'
     });

        // initialize and add onChange event
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
        // force onChange  event to fire on initialization
        $('.ui.dropdown')
        .closest('.ui.selection')
        .find('.item.active').addClass('qwerty').end()
        .dropdown('clear')
        .find('.qwerty').removeClass('qwerty')
        .trigger('click');

        $('.message .close').on('click', function() {
            $(this).closest('.message').transition('fade');
        });
    });

    $(document)
        .on('click', '.ui.file.input input:text, .ui.button.file', function(e) {
            $(e.target).parent().find('input:file').click();
        })
        ;

        $(document)
        .on('change', '.ui.file.input input:file', function(e) {
            var file = $(e.target);
            var name = '';

            for (var i=0; i<e.target.files.length; i++) {
              name += e.target.files[i].name + ', ';
          }
                    // remove trailing ","
                    name = name.replace(/,\s*$/, '');
                    console.log(name);

                    $('input:text', file.parent()).val(name);
                })
        ;



</script>

@yield('scripts')
@yield('addmore')
</body>
</html>
