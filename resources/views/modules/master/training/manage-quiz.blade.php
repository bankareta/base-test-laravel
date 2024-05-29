@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
    <style>
        iframe{
            height: 300px !important;
        }
        .ui.embed{
            padding-bottom: 0%
        }
        .visible.transition {
          margin-top: auto !important;
          display: inline-block !important;
          position: relative;
          top: 0%;
        }

    </style>
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
        url: "{{ url($pageUrl) }}/grid-question",
        type: 'POST',
        data: function (d) {
            d._token = "{{ csrf_token() }}";
            d.quiz_id = "{{ $record->id }}";
            d.search = $('input[name="filter[search]"]').val();
        }
    },
    columns: {!! json_encode($questionStruct) !!},
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

function loadPdfModal(element)
{
	$('.ui.large.modal').modal({
		onShow: function () {
			$('#showPdf').html(`<embed src="`+$(element).attr('data-pdf')+`" width="100%" height="800px" type="application/pdf">`)
		}
	}).modal('show');
}

function loadModalVideo(element)
{
  $('.ui.large.modal').modal({
    onShow: function () {
      $('#showPdf').html(`<video width="100%" controls>
          <source src="`+$(element).attr('data-video')+`" type="video/mp4">
          Your browser does not support the video tag.
          </video>`)
    }
  }).modal('show');
}

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
$('.ui.embed').embed();

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
                    // if(response.url){
                    //     location.href = '{{ url($pageUrl) }}';
                    // }else if(response.redirect){
                    //     if(response.redirect != '-'){
                    //         showData(response.redirect);
                    //         window.history.pushState("", "");
                    //     }else{
                            location.href = '{{ url($pageUrl) }}';
                    //     }

                    // }else{
                    //     dt.draw('page');
                    //     return true;
                    // }
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
    					<a class="active item" data-tab="first">Training Detail</a>
                        <a class="item" data-tab="second">Training File</a>
    					<a class="item" data-tab="three">Training Setting</a>
    					<a class="item" data-tab="four">Training Participant</a>
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
    				</div>
    				<div class="ui attached tab segment" data-tab="second">
    					<div class="ui center aligned grid">
    						<div class="column">
    							{!! $record->getEmbedFile() !!}
    						</div>
    					</div>
    					<div class="ui center aligned grid">
    						<div class="column">
    							{!! $record->getEmbedYoutube() !!}
    						</div>
    					</div>
    				</div>
    				<div class="ui attached tab segment" data-tab="three">
                        <table class="ui celled table">
                            <tbody>
                                <tr>
                                    <td colspan="2"><b>Time Limit</b>  <br><small class="font red"><i>(checked here if this quiz have a time limit)</i></small></td>
                                    <td colspan="2"><b>Percentage Minimum Score</b>  <br>  <small class="font red"><i>(checked here if this quiz have minimum score)</i></small></td>
                                    <td colspan="2"><b>Retake Quiz</b>  <br>  <small class="font red"><i>(checked here if this quiz can be retake when user doesnt pass the minimum score)</i></small></td>
                                </tr>
                                <tr>
                                    <td class="center aligned middle aligned one wide">
                                        <div class="field">
                                            <div class="ui checkbox {{ $record->time_limit == 1 ? 'checked' : '' }}" disabled>
                                                <input type="checkbox" name="time_limit" value="1" {{ $record->time_limit == 1 ? 'checked' : '' }} disabled>
                                                <label>&nbsp;</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="two wide">
                                        <div class="field">
                                            <div class="ui labeled input timelimit">
                                                <input type="number" step="1" placeholder="minutes" class="timelimit" name="time_limit_minutes" value="{{ $record->time_limit_minutes or '' }}" readonly>
                                                <div class="ui label">
                                                    Minutes
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="center aligned middle aligned one wide">
                                        <div class="field">
                                            <div class="ui checkbox {{ $record->min_score == 1 ? 'checked' : '' }}" disabled>
                                                <input type="checkbox" name="min_score" value="1" {{ $record->min_score == 1 ? 'checked' : '' }} disabled>
                                                <label>&nbsp;</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="two wide">
                                        <div class="field">
                                            <div class="ui labeled input minscore">
                                                <input type="number" name="min_score_percentage" value="{{ $record->min_score_percentage or '' }}" readonly>
                                                <div class="ui label">
                                                    %
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="left aligned middle aligned four wide">
                                        <div class="grouped fields">
                                            <div class="field">
                                                <div class="ui checkbox minscore disabled {{ $record->retake == 1 ? 'checked' : '' }}">
                                                    <input type="checkbox" name="retake" class="minscore" value="1" disabled {{ $record->retake == 1 ? 'checked' : '' }}>
                                                    <label>immediately</label>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="ui checkbox minscore disabled {{ $record->retake == 2 ? 'checked' : '' }}">
                                                    <input type="checkbox" name="retake" class="minscore" value="2" disabled  {{ $record->retake == 2 ? 'checked' : '' }}>
                                                    <label>days</label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="two wide">
                                        <div class="field">
                                            <div class="ui labeled input retake">
                                                <input type="number" name="retake_days" value="{{ $record->retake_days or '' }}" readonly>
                                                <div class="ui label">
                                                    day
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Effective Date</b>  <br>  <small class="font red"><i>(Effective date quiz will start)</i></small></td>
                                    <td colspan="2"><b>Expired Date</b>  <br>  <small class="font red"><i>(Expired date, quiz cant be take after expired date)</i></small></td>
                                    <td colspan="2"><b>Repeat Quiz</b>  <br><small class="font red"><i>(checked here if you want quiz to be repeat when quiz expired)</i></small></td>
                                </tr>
                                <tr>
                                    <td class="two wide" colspan="2">
                                        <div class="field">
                                            <div class="field">
                                                <input type="text" name="effective_date" placeholder="Effective Date" readonly value="{{ Helpers::DateToString($record->effective_date) }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="center aligned middle aligned one wide">
                                        <div class="field">
                                            <div class="ui checkbox" {{ $record->expired == 1 ? 'checked' : '' }}>
                                                <input type="checkbox" name="expired" value="1"  {{ $record->expired == 1 ? 'checked' : '' }} disabled>
                                                <label>&nbsp;</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="two wide">
                                        <div class="field">
                                            <div class="field">
                                                <input type="text" name="expired_date" placeholder="Expired Date" readonly  value="{{ Helpers::DateToString($record->expired_date) }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="center aligned middle aligned one wide">
                                        <div class="field">
                                            <div class="ui checkbox {{ $record->repeat == 1 ? 'checked' : '' }}">
                                                <input type="checkbox" name="repeat" value="1" {{ $record->repeat == 1 ? 'checked' : '' }} disabled>
                                                <label>&nbsp;</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="two wide">
                                        <div class="field">
                                            <div class="ui labeled input repeatmonths disabled">
                                                <input type="number" step="1" name="repeat_months" class="repeatmonths" disabled value="{{ $record->repeat_months or '' }}">
                                                <div class="ui label">
                                                    Months
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center aligned middle aligned four wide">
                                        <div class="field">
                                            <div class="ui checkbox {{ $record->sent_email == 1 ? 'checked' : '' }}">
                                                <input type="checkbox" name="sent_email" value="1" {{ $record->sent_email == 1 ? 'checked' : '' }} disabled>
                                                <label>&nbsp;</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="3" class="sendemail disabled"><b>Sent Email Alert</b>  <br>  <small class="font red"><i>(Sent alert email to each participant)</i></small></td>
                                    <td colspan="2">
                                        <div class="grouped fields">
                                            <label>Required ? <br>  <small class="font red"><i>(Checked the field's)</i></small></label>

                                            <div class="field">
                                                <div class="ui radio">
                                                    <input type="radio" name="mandatory" value="1" {{ ($record->mandatory == 1) ? 'checked' : '' }}>
                                                    <label>Mandatory</label>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="ui radio">
                                                    <input type="radio" name="mandatory" value="2" {{ ($record->mandatory == 2) ? 'checked' : '' }}>
                                                    <label>Not Mandatory</label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                </tr>
                            </tbody>
                        </table>

                        <div class="fields">

                        </div>
    				</div>
    				<div class="ui attached tab segment" data-tab="four">
                        <div class="field">
                            <div class="ui big very relaxed horizontal list">
                                @foreach($users as $user)
                                    <div class="item">
                                        <img class="ui avatar image" src="{{ $user->showfotopath() }}">
                                        <div class="content">
                                            <div class="header">{!! $user->display !!}</div>
                                            <small>{!! $user->showroles() !!}</small><br>
                                            <small><i>{!! $user->siteOn() !!}</i></small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="field">
                            @include('pagination.custom', ['paginator' => $users])
                        </div>
    				</div>
                    <h4 class="ui horizontal divider header">
                        <i class="tag icon"></i>
                        List Question
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
                          @if($record->published == 0)
                            <div style="margin-left: auto; margin-right: 1px;">
                                <a href="{{ url($pageUrl.'create-question/'.$record->id) }}" class="ui blue add-page button">
                                    <i class="plus icon"></i>
                                    Create New Data
                                </a>
                            </div>
                          @endif
                        </div>
                    </form>
                    <table id="quizTable" class="ui celled compact red table display" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                @foreach ($questionStruct as $struct)
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
                    @if ($record->published == 0 AND $record->question->count() > 0)
                        <div class="right aligned column">
                            <a class="ui black icon button" onclick="publishedQuiz('{{ url($pageUrl.'published-quiz/'.$record->id) }}')">
                                Publish
                                <i class="share icon"></i>
                            </a>
                        </div>
                    @endif
        		</div>
        	</div>
        </div>
    </div>

  	<div class="ui large modal">
  	  <div id="showPdf">
  	    <p>Your inbox is getting full, would you like us to enable automatic archiving of old messages?</p>
  	  </div>
  	</div>
@endsection
