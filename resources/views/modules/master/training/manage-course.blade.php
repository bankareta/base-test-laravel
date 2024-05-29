@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('scripts')
<script type="text/javascript">
table = $('#quizTable').DataTable({
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
        url: "{{ url($pageUrl) }}/grid-quiz",
        type: 'POST',
        data: function (d) {
            d._token = "{{ csrf_token() }}";
            d.course_id = "{{ $record->id }}";
            d.search = $('input[name="filter[search]"]').val();
        }
    },
    columns: {!! json_encode($quizStruct) !!},
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
    // dt.ajax.reload();
    e.preventDefault();
});

$('.reset.button').on('click', function(e) {
    $('input[name^="filter"]').val('');
    e.preventDefault();
    table.draw();
    e.preventDefault();
});
$('.ui.tabular .item').tab();
$('.ui.tabular .item').tab({
    onLoad: function (e) {
        window.location.hash = e;
    },
});

function deleteQuiz(url) {
    swal({
        title: 'Delete Data',
        html: "Are you sure you want to delete the data? <br>The data can not be returned.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Confirm',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
    }).then((result) => {
        if (result) {
            $('#cover').css('display','');
            $.ajax({
                url: url,
                type: 'POST',
                // dataType: 'json',
                data: {
                    '_method' : 'DELETE',
                    '_token' : '{{ csrf_token() }}'
                }
            })
            .done(function(response) {
                $('#cover').css('display','none');
                swal({
                    title: 'Successfully Deleted',
                    text: " ",
                    type: 'success',
                    allowOutsideClick: false
                }).then((res) => {
                    if(response.url){
                        location.href = '{{ url($pageUrl) }}';
                    }else if(response.redirect){
                        if(response.redirect != '-'){
                            showData(response.redirect);
                            window.history.pushState("", "");
                        }else{
                            location.href = '{{ url($pageUrl) }}';
                        }

                    }else{
                        table.draw('page');
                        return true;
                    }
                })
            })
            .fail(function(response) {
                $('#cover').css('display','none');
                swal({
                    title: 'Failed to Delete',
                    text: " ",
                    type: 'error',
                    allowOutsideClick: false
                }).then((res) => {

                })
            })

        }
    })
}

function publishedQuiz(url) {
    swal({
        title: 'Published',
        html: "Are you sure you want to publish the data? <br>The data can not be edited after published.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Confirm',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
    }).then((result) => {
        if (result) {
            $('#cover').css('display','');
            $.ajax({
                url: url,
                type: 'POST',
                // dataType: 'json',
                data: {
                    '_method' : 'PUT',
                    '_token' : '{{ csrf_token() }}'
                }
            })
            .done(function(response) {
                $('#cover').css('display','none');
                swal({
                    title: 'Successfully Published',
                    text: " ",
                    type: 'success',
                    allowOutsideClick: false
                }).then((res) => {
                    if(response.url){
                        location.href = '{{ url($pageUrl) }}';
                    }else if(response.redirect){
                        if(response.redirect != '-'){
                            showData(response.redirect);
                            window.history.pushState("", "");
                        }else{
                            location.href = '{{ url($pageUrl) }}';
                        }

                    }else{
                        table.draw('page');
                        return true;
                    }
                })
            })
            .fail(function(response) {
                $('#cover').css('display','none');
                swal({
                    title: 'Failed to Delete',
                    text: " ",
                    type: 'error',
                    allowOutsideClick: false
                }).then((res) => {

                })
            })

        }
    })
}

$('.ui.pagination.right.menu a.item').on('click', function (element) {
    element.preventDefault();
    var hash = window.location.hash;
    var href = $(this).attr('href') + hash;

    window.location = href;
});
$(document).ready(function () {
    var hash = window.location.hash;
    var tab = hash.substr(1)
    $('.ui.tabular .item[data-tab="'+ tab +'"]').trigger('click');
})
</script>
@append

@section('content-body')
    <div class="ui grid">
        <div class="sixteen wide column main-content">
            <div class="ui top attached segment">
    			<div class="ui form">
    				{!! csrf_field() !!}
    				<input type="hidden" name="id" value="{{ $record->id }}">
    				<input type="hidden" name="_method" value="PUT">
    				<div class="ui top attached tabular menu">
    					<a class="active item" data-tab="first">Course Detail</a>
    					<a class="item" data-tab="three">Course Participant</a>
    				</div>
    				<div class="ui attached active tab segment" data-tab="first">
    					<input type="hidden" name="status" value="0">
    					<div class="field">
    						<label>Title</label>
    						<input type="text" name="title" placeholder="Title" value="{{ $record->title or '' }}" readonly>
    					</div>
    					<div class="field">
    						<label>Contents</label>
    						<textarea name="contents" placeholder="Contents" readonly>{!! $record->contents or '' !!}</textarea>
    					</div>
    					<div class="field">
    						<label>Site</label>
                <input type="text" name="title" placeholder="Title" value="{{ $record->company ? $record->company->name : '' }}" readonly>
    					</div>
    					<div class="field">
    						<label>Training Type</label>
                <input type="text" name="title" placeholder="Title" value="{{ $record->type ? $record->type->name : '' }}" readonly>
    					</div>
    				</div>
    				<div class="ui attached tab segment" data-tab="three">
                        <div class="field">
                            <table class="ui celled structured table">
                                <thead>
                                    <tr>
                                        <th class="center aligned">No</th>
                                        <th class="center aligned">Name</th>
                                        <th class="center aligned">Role</th>
                                        <th class="center aligned">Company</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $key => $user)
                                    <tr>
                                        <td class="center aligned">{{ $key+1 }}</td>
                                        <td>
                                            <img class="ui avatar image" src="{{ $user->showfotopath() }}">
                                            {!! $user->display !!}
                                        </td>
                                        <td>{!! $user->showroles() !!}</td>
                                        <td>{!! $user->siteOn() !!}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="field">
                            @include('pagination.custom', ['paginator' => $users])
                        </div>
    				</div>
                    <h4 class="ui horizontal divider header">
                        <i class="tag icon"></i>
                        List Quiz
                    </h4>
                    <form class="ui filter form">
                        <div class="inline fields">
                            <div class="ui three wide field">
                                <input name="filter[search]" placeholder="Quiz Title" type="text">
                            </div>
                        	<button type="button" class="ui teal icon filter button" data-content="Search Data">
                        		<i class="search icon"></i>
                        	</button>
                        	<button type="reset" class="ui icon reset button" data-content="Clear Search">
                        		<i class="refresh icon"></i>
                        	</button>
                            <div style="margin-left: auto; margin-right: 1px;">
                                <a href="{{ url($pageUrl.'create-quiz/'.$record->id) }}" class="ui blue add-page button">
                                    <i class="plus icon"></i>
                                    Create New Data
                                </a>
                            </div>
                        </div>
                    </form>
                    <table id="quizTable" class="ui celled compact red table display" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                @foreach ($quizStruct as $struct)
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
