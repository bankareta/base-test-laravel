@extends('layouts.base')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/smantic/responsive.semanticui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.semanticui.css') }}">
    <style type="text/css">
        td.details-control.button {
            background: green no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control.button {
            background: red no-repeat center center;
        }
        .text-center {
            text-align: center !important;
        }
        /* .odd{
            background-color: #fff !important;
        } */
    </style>
@append

@section('js')
    <script src="{{ asset('js/file-saver.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert2.js') }}"></script>
@append

@section('scripts')
    <script type="text/javascript">
      $('.message .close')
        .on('click', function() {
          $(this)
            .closest('.message')
            .transition('fade')
          ;
        })
      ;
        // global
        var dt = "";
        var formRules = [];
        var onShow = function(){
            $('.checkbox').checkbox();
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

            return false;
        };

        $.fn.form.settings.prompt = {
            empty                : '{name} tidak boleh kosong',
            checked              : '{name} harus dipilih',
            email                : '{name} tidak valid',
            url                  : '{name} tidak valid',
            regExp               : '{name} is not formatted correctly',
            integer              : '{name} must be an integer',
            decimal              : '{name} must be a decimal number',
            number               : '{name} hanya boleh berisikan angka',
            is                   : '{name} must be "{ruleValue}"',
            isExactly            : '{name} must be exactly "{ruleValue}"',
            not                  : '{name} cannot be set to "{ruleValue}"',
            notExactly           : '{name} cannot be set to exactly "{ruleValue}"',
            contain              : '{name} cannot contain "{ruleValue}"',
            containExactly       : '{name} cannot contain exactly "{ruleValue}"',
            doesntContain        : '{name} must contain  "{ruleValue}"',
            doesntContainExactly : '{name} must contain exactly "{ruleValue}"',
            minLength            : '{name} setidaknya haru memiliki {ruleValue} karakter',
            length               : '{name} must be at least {ruleValue} characters',
            exactLength          : '{name} must be exactly {ruleValue} characters',
            maxLength            : '{name} tidak boleh lebih dari {ruleValue} karakter',
            match                : '{name} must match {ruleValue} field',
            different            : '{name} must have a different value than {ruleValue} field',
            creditCard           : '{name} must be a valid credit card number',
            minCount             : '{name} must have at least {ruleValue} choices',
            exactCount           : '{name} must have exactly {ruleValue} choices',
            maxCount             : '{name} must have {ruleValue} or less choices'
        };

        $(document).on('click', '.ui.add.button', function(event) {
            event.preventDefault();
            // /* Act on the event */
            loadModal({
                'url' : '{{ url($pageUrl) }}/create',
                'modal' : '.{{ $modalSize }}.modal',
                'formId' : '#dataForm',
                'onShow' : function(){
                    onShow();
                },
            })
        });

        $(document).on('click', '.ui.add-page.button', function(event) {
            var url = "{{ url($pageUrl) }}/create";
	        window.location = url;
        });

        $(document).on('click', '.ui.add-custome.button', function(event) {
            event.preventDefault();
            // /* Act on the event */
            loadModal({
                'url' : $(this).data('url'),
                'modal' : '.{{ $modalSize }}.modal',
                'formId' : '#dataForm',
                'onShow' : function(){
                    onShow();
                },
            })
        });

        $(document).on('click', '.ui.edit.button', function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            // /* Act on the event */
            loadModal({
                'url' : '{{ url($pageUrl) }}/'+id+'/edit',
                'modal' : '.{{ $modalSize }}.modal',
                'formId' : '#dataForm',
                'onShow' : function(){
                    onShow();
                },
            })
        });

        $(document).on('click', '.delete2.button', function(e){
            e.preventDefault();
            var delete2 = $(this).data('urls');
            deleteData(delete2);
        });

        $(document).on('click', '.all-custome', function(event) {
            event.preventDefault();
            // /* Act on the event */
            loadModal({
                'url' : $(this).data('url'),
                'modal' : '.{{ $modalSize }}.modal',
                'formId' : '#dataForm',
                'onShow' : function(){
                    onShow();
                },
            })
        });

         $(document).on('click', '.delete-custome', function(e){
            var delete2 = $(this).data('url');
            customeDeleteData(delete2);
        });
        
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
    </script>
    @yield('rules')
    @yield('init-modal')

    @include('scripts.datatable')
    @include('scripts.action')
@append

@section('content')
    @section('content-header')
    @if ($monitorPage)
        <div class="ui breadcrumb">
            <a href="{{ url($pageUrl) }}" class="active ui labeled icon button"><i class="pencil icon"></i> Form</a>
            <a href="{{ url($pageUrl) }}/monitoring" class="ui labeled icon button"><i class="chart bar icon"></i> Monitoring</a>
        </div>
    @else
        <div class="ui breadcrumb">
            <div class="active section"><i class="home icon"></i></div>
            <i class="right chevron icon divider"></i>
            <?php $i=1; $last=count($breadcrumb);?>
            @foreach ($breadcrumb as $name => $link)
                @if($i++ != $last)
                    <a href="{{ $link }}" class="section">{{ $name }}</a>
                    <i class="right chevron icon divider"></i>
                @else
                    <div class="active section">{{ $name }}</div>
                @endif
            @endforeach
        </div>
    @endif
    <h3 class="ui header">
      <div class="content" style="">
        {!! $title or '-' !!}
        {{-- <div class="sub header">{!! $subtitle or ' ' !!}</div> --}}
      </div>
    </h3>
    @show
    <div class="ui clearfix"></div>
    <div class="ui clearing divider" style="border-top: none !important; margin:10px"></div>

    @section('content-body')

    @if(session('errors'))
      <div class="ui warning message">
        <i class="close icon"></i>
        <div class="header">
          <strong>Whoops!</strong> There were some problems with your record.<br><br>
        </div>
        <ul class="list">
          @foreach (session('errors') as $error => $message)
              <li>{{ $error }} - {{ $message }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if($errorPage)
      <div class="ui warning message">
        <i class="close icon"></i>
        <div class="header">
          <strong>Whoops!</strong> There were some problems with your record.<br><br>
        </div>
        <ul class="list">
          @foreach ($errorPage as $error => $message)
              <li>{{ $error }} - {{ $message }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="ui grid">
        <div class="sixteen wide column main-content">
            <div class="ui segments">
                <div class="ui segment">
                    <form class="ui filter form">
                        <div class="inline fields">
                            @section('filters')
                                <div class="ui three wide field">
                                    <input name="filter[search]" placeholder="No.Pendaftaran/Nama/UN" type="text">
                                </div>
                                <button type="button" class="ui teal icon filter button" data-content="Find Data">
                                    <i class="search icon"></i>
                                    &nbsp;&nbsp;Search
                                </button>
                            @show
                            <div style="margin-left: auto; margin-right: 1px;">
                                @section('toolbars')
                                    @can($pagePerms.'-add')
                                    <button type="button" class="ui blue @if($pagePerms != '' && !auth()->user()->can($pagePerms.'-add')) disabled @endif button add">
                                        <i class="add icon"></i>
                                        Create New Data
                                    </button>
                                    @endcan
                                @show
                            </div>
                        </div>
                    </form>

                    @section('subcontent')
                        @if(isset($tableStruct))
                        <table id="listTable" class="ui celled compact red table display" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    @foreach ($tableStruct as $struct)
                                        <th class="center aligned">{{ $struct['label'] or $struct['name'] }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @yield('tableBody')
                            </tbody>
                        </table>
                        @endif
                    @show
                </div>
                @section('bottom-act')
                @show
            </div>
        </div>
    </div>
    @show

    @section('content-body-footer')

    @show
@endsection

@section('modals')

@append
