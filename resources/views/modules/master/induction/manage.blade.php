@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('scripts')
<script type="text/javascript">
    table = $('#planTable').DataTable({
        dom: 'rt<"bottom"ip><"clear">',
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        pageLength: 10,
        filter: false,
        sorting: [],
        stripeClasses: [],
        language: {
            url: "{{ asset('plugins/datatables/English.json') }}"
        },
        ajax:  {
            url: "{{ url($pageUrl) }}/grid-plan",
            type: 'POST',
            data: function (d) {
                d._token = "{{ csrf_token() }}";
                d.materi_id = "{{ $record->id }}";
                d.search = $('input[name="filter[search]"]').val();
                d.start_date = $('input[name="filter[date_induction_start]"]').val();
                d.end_date = $('input[name="filter[date_induction_end]"]').val();
            }
        },
        columns: {!! json_encode($planStruct) !!},
        drawCallback: function() {
            var api = this.api();

            api.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i, x, y) {
                cell.innerHTML = parseInt(cell.innerHTML)+i+1;
                // cell.innerHTML = i+1;
            } );

            $('[data-content]').popup({
                hoverable: true,
                position : 'top center',
                delay: {
                    show: 300,
                    hide: 800
                }
            });
        }
    });

    $('select[name="filter[page]"]').on('change', function(e) {
        var length = this.value // $("input[name='filter[entri]']").val();
        length = (length != '') ? length : 10;
        table.page.len(length).draw();
        e.preventDefault();
    });

    $('.filter.button').on('click', function(e) {
        table.draw();
        e.preventDefault();
    });

    $('.reset.button').on('click', function(e) {
        $('input[name^="filter"]').val('');
        e.preventDefault();
        table.draw();
        e.preventDefault();
    });

    function getId(url) {
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = url.match(regExp);

        if (match && match[2].length == 11) {
            return match[2];
        } else {
            return 'error';
        }
    }
    function openFullscreen() {
        var elem = document.getElementById("showframe");
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.webkitRequestFullscreen) { /* Safari */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE11 */
            elem.msRequestFullscreen();
        }
    }
    $('.modal-file').on('click', function(e) {
        $(window).scrollTop(0);
        event.preventDefault();
        // /* Act on the event */
        loadModal({
            'url' : '{{ url($pageUrl) }}/show-file/'+$(this).data('url')+'/'+$(this).data('type'),
            'modal' : '.large.modal',
            'formId' : '#dataForm',
            'onShow' : function(){
                onShow();
                url = $('#myCode').data('url');
                if(url){
                    url = getId(url);
                    $('#myCode').html('<iframe style="width: 100%;height: 600px;" src="//www.youtube.com/embed/' + url + '?autoplay=1" frameborder="0" allowfullscreen></iframe>');
                }
            },
        })
    });

    $('.add-modal-new').on('click', function(event) {
        $(window).scrollTop(0);
        event.preventDefault();
        // /* Act on the event */
        loadModal({
            'url' : '{{ url($pageUrl) }}/add-plan/'+$(this).data('id'),
            'modal' : '.mini.modal',
            'formId' : '#dataForm',
            'onShow' : function(){
                onShow();
            },
        })
    });

    $('.publish-materi').on('click', function(event) {
        swal({
            title: "Publish Now?",
            text: "Data can be published if you have created questions for this material and cannot add questions if the data has been published.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Publish',
            reverseButtons: true,
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result) {
                $('#dataForm').find('.loading.dimmer').addClass('active');
                $('#cover').css('display','');
                $.ajax({
                    url: "{{ url($pageUrl) }}/publish-materi/{{ $record->id }}",
                    type: 'GET',
                    success: function(resp){
                        $('#cover').css('display','none');
                        $('#cover').find('.loading.dimmer').removeClass('active');
                        if(resp.status){
                            swal({
                                title: 'Success.',
                                text: "The data has been published ",
                                type: 'success',
                                allowOutsideClick: false
                            }).then((res) => {
                                location.reload();
                            })
                        }else{
                            swal({
                                title: 'Failed to Publish',
                                text: "You haven't added questions on this material.",
                                type: 'error',
                                allowOutsideClick: false
                            }).then((res) => {

                            })
                        }
                    },
                    error : function(resp){
                        $('#cover').css('display','none');
                        $('#dataForm').find('.loading.dimmer').removeClass('active');
                        swal({
                            title: 'Failed to Publish',
                            text: "You haven't added questions on this material.",
                            type: 'error',
                            allowOutsideClick: false
                        }).then((res) => {

                        })
                    }
                });
            }
        })
    });
</script>
@append

@section('content-body')
    <div class="ui grid">
        <div class="sixteen wide column main-content">
            <div class="ui top attached segment">
                <h4 class="ui horizontal divider header">
                    <i class="file icon"></i>
                    Induction Material
                </h4>
                @if ($record->status == 1)
                    <a class="ui red right corner label" style="font-size: 22px">
                        <i class="check icon"></i>
                    </a>
                @endif
                <table class="ui celled table">
                    <tbody>
                        <tr>
                            <td width="10%"><b>Material Name :</b></td>
                            <td>{{ $record->name }}</td>
                        </tr>
                        <tr>
                            <td width="10%"><b>Induction Type :</b></td>
                            <td>{{ $record->type->name }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-bottom: 25px;">
                                <u><h3 style="text-align: center">Attachment Induction Material</h3></u>
                                <div class="ui divider"></div>
                                <div class="ui dimmable centered special five cards">
                                    @if ($record->link_yt)
                                        <div class="ui dimmable small card">
                                            <div class="blurring dimmable image">
                                                <div class="ui dimmer">
                                                    <div class="content">
                                                        <div class="center">
                                                            <a href="#" class="ui inverted massive blue icon button modal-file" data-type="yt" data-url="{{ base64_encode($record->id) }}"><i class="eye icon"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <img src="{{ url('img/extension/yt.jpg') }}">
                                            </div>
                                            <div class="extra content">
                                                <a>
                                                    <i class="users icon"></i>
                                                    YT Attachment
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    @switch(Helpers::showFileExtension($record->fileurl))
                                        @case('pdf')
                                                <div class="ui dimmable small card">
                                                    <div class="blurring dimmable image">
                                                        <div class="ui dimmer">
                                                            <div class="content">
                                                                <div class="center">
                                                                    <a href="#" class="ui inverted massive blue icon button modal-file" data-url="{{ base64_encode($record->fileurl) }}"><i class="eye icon"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <img src="{{ Helpers::showImgExtension($record->fileurl,true) }}">
                                                    </div>
                                                    <div class="extra content">
                                                        <a>
                                                            <i class="users icon"></i>
                                                            {{ substr($record->filename,0,14) }}...
                                                        </a>
                                                    </div>
                                                </div>
                                            @break
                                        @case('film')
                                            <div class="ui dimmable small card">
                                                <div class="blurring dimmable image">
                                                    <div class="ui dimmer">
                                                        <div class="content">
                                                            <div class="center">
                                                                <a href="#" class="ui inverted massive blue icon button modal-file" data-type="video" data-url="{{ base64_encode($record->fileurl) }}"><i class="eye icon"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <img src="{{ Helpers::showImgExtension($record->fileurl,true) }}">
                                                </div>
                                                <div class="extra content">
                                                    <a>
                                                    <i class="users icon"></i>
                                                        Video Attachment
                                                    </a>
                                                </div>
                                            </div>
                                            @break
                                        @default
                                        <div class="ui dimmable small card">
                                            <div class="blurring dimmable image">
                                                <div class="ui dimmer">
                                                    <div class="content">
                                                        <div class="center">
                                                            <a href="{!! url('download-file/'.base64_encode($record->fileurl).'/'.$record->filename) !!}" target="_blank" class="ui inverted massive blue icon button"><i class="download icon"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <img src="{{ Helpers::showImgExtension($record->fileurl,true) }}">
                                            </div>
                                            <div class="extra content">
                                                <a>
                                                    <i class="users icon"></i>
                                                    {{ substr($record->filename,0,14) }}...
                                                </a>
                                            </div>
                                        </div>
                                    @endswitch
                                    @if ($record->child->count() > 0)
                                        @foreach ($record->child as $child)
                                            @switch(Helpers::showFileExtension($child->fileurl))
                                                @case('pdf')
                                                    <div class="small card">
                                                        <div class="blurring dimmable image">
                                                            <div class="ui dimmer">
                                                                <div class="content">
                                                                    <div class="center">
                                                                        <a href="#" class="ui inverted massive blue icon button modal-file" data-url="{{ base64_encode($child->fileurl) }}"><i class="eye icon"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <img src="{{ Helpers::showImgExtension($child->fileurl,true) }}">
                                                        </div>
                                                        <div class="extra content">
                                                            <a>
                                                                <i class="users icon"></i>
                                                                {{ substr($child->filename,0,14) }}...
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @break
                                                @case('film')
                                                    <div class="ui dimmable small card">
                                                        <div class="blurring dimmable image">
                                                            <div class="ui dimmer">
                                                                <div class="content">
                                                                    <div class="center">
                                                                        <a href="#" class="ui inverted massive blue icon button modal-file" data-type="video" data-url="{{ base64_encode($child->fileurl) }}"><i class="eye icon"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <img src="{{ Helpers::showImgExtension($child->fileurl,true) }}">
                                                        </div>
                                                        <div class="extra content">
                                                            <a>
                                                            <i class="users icon"></i>
                                                                Video Attachment
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @break
                                                @default
                                                <div class="ui dimmable small card">
                                                    <div class="blurring dimmable image">
                                                        <div class="ui dimmer">
                                                            <div class="content">
                                                                <div class="center">
                                                                    <a href="{!! url('download-file/'.base64_encode($child->fileurl).'/'.$child->filename) !!}" target="_blank" class="ui inverted massive blue icon button"><i class="download icon"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <img src="{{ Helpers::showImgExtension($child->fileurl,true) }}">
                                                    </div>
                                                    <div class="extra content">
                                                        <a>
                                                            <i class="users icon"></i>
                                                            {{ substr($child->filename,0,14) }}...
                                                        </a>
                                                    </div>
                                                </div>
                                            @endswitch
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="center aligned">
                                    @if ($record->status == 0)
                                    <button type="button" class="ui gmf red publish-materi button" data-id="{{ $record->id }}">
                                        <i class="check icon"></i>
                                        Publish this material for Create Induction Plan
                                    </button>
                                    @endif
                                </td>
                            </tr>
                    </tbody>
                </table>
    			<div class="ui form">
    				{!! csrf_field() !!}
    				<input type="hidden" name="id" value="{{ $record->id }}">
    				<input type="hidden" name="_method" value="PUT">
                    <h4 class="ui horizontal divider header">
                        <i class="tag icon"></i>
                        List Induction Plan
                    </h4>
                    <form class="ui filter form">
                        <div class="inline fields">
                            <div class="ui three wide field">
                                <input name="filter[search]" placeholder="Induction Title" type="text">
                            </div>
                            <div class="field startdate">
                                <input type="text" placeholder="Start Date" name="filter[date_induction_start]">
                            </div>
                            <div class="field enddate">
                                <input type="text" placeholder="End Date" name="filter[date_induction_end]">
                            </div>
                        	<button type="button" class="ui teal icon filter button" data-content="Search Data">
                        		<i class="search icon"></i>
                        	</button>
                        	<button type="reset" class="ui icon reset button" data-content="Clear Search">
                        		<i class="refresh icon"></i>
                        	</button>
                            <div style="margin-left: auto; margin-right: 1px;">
                                <button type="button" class="ui gmf teal add-modal-new button {{ $record->status == 1 ? '' : 'disabled' }}" data-id="{{ $record->id }}">
                                    <i class="plus icon"></i>
                                    Create New Induction Plan
                                </button>
                                <a href="{{ url($pageUrl.'create-question/'.$record->id) }}/" class="ui blue add-page button {{ $record->without_quiz == 1 ? 'disabled' : '' }}">
                                    <i class="plus icon"></i>
                                    Manage Question for this Material
                                </a>
                            </div>
                        </div>
                    </form>
                    <table id="planTable" class="ui celled compact red table display" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                @foreach ($planStruct as $struct)
                                    <th class="center aligned">{{ $struct['label'] or $struct['name'] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                    </table>
    			</div>
    		</div>
        	<div class="ui bottom attached segment">
        		<div class="ui two column grid">
        			<div class="left aligned column">
        				<a class="ui labeled icon button" href="{{ url($pageUrl) }}">
        					<i class="chevron left icon"></i>
        					Back
        				</a>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
@endsection
@section('init-modal')
@include('modules.master.induction.script')
@endsection
