@extends('layouts.base')

@section('css')
@append

@section('styles')
    <style type="text/css">
        .text-center {
            text-align: center !important;
        }
        .ui.radio.checkbox {
            margin: 0px !important;
        }
        .results.transition.visible{
            width: 31em !important;
        }
        .min-content {
            min-height: 250px;
        }
    </style>
@append

@section('js')
@append

@section('scripts')
    <script type="text/javascript">
      var dt = "";
        var formRules = [];
        var onShow = function(){
            $('.checkbox').checkbox();
            $('.ui.dropdown').dropdown({
                onchange: function(value) {
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
        $(document).on('click', '.save.page.button', function(e){
            swal({
                title: "Save Data",
                text: "Is the data that you want to save is appropriate??",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save',
			    reverseButtons: true,
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result) {
                    saveData('dataForm');
                }
            })
        })

        $(document).on('click', '.draft.page.button', function(e){
            saveData('dataForm');
        })

        $(document).on('click', '.deny.page.button', function(e){
            location.href = "{{ url($pageUrl) }}";
        })

        $(document).on('click', '.back.page.button', function(e){
            location.href = "/";
        });

        $(document).on('click', '.open.new.page.button', function(e){
            var id = $(this).data('url');
            getNewTab(id,'');
        });

        $('.date').calendar({
            type: 'date',
        });

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

        $(document).on('click', '.all-custome', function(event) {
            console.log('ampas');
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
    @include('scripts.action')
@append

@yield('adding-script')

@section('content')
    @section('content-header')
    <div class="ui breadcrumb">
        <a href="{{ url($pageUrl) }}" class="ui labeled icon button"><i class="pencil icon"></i> Form</a>
        <a href="{{ url($pageUrl) }}/monitoring" class="active ui labeled icon button"><i class="chart bar icon"></i> Monitoring</a>
    </div>
    <h2 class="ui header">
      <div class="content">
        {!! $title or '-' !!}
        {{-- <div class="sub header">{!! $subtitle or ' ' !!}</div> --}}
      </div>
    </h2>
    @show
    <div class="ui clearfix"></div>
    <div class="ui clearing divider" style="border-top: none !important; margin:10px"></div>

    @section('content-body')
    <div class="ui centered grid">
        <div class="{{ isset($form_class)?$form_class:'' }} column main-content">
            <div class="ui segments">
                <div class="ui segment">
                    @yield('form')
                </div>
            </div>
        </div>
    </div>
    @show
@endsection


@section('modals')
<div class="ui big modal" id="formModal">
    <div class="ui inverted loading dimmer">
        <div class="ui text loader">Loading</div>
    </div>
</div>
@append
