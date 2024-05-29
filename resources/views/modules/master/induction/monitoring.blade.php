@extends('layouts.list')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">
@append

@section('js')
<script src="{{ asset('plugins/semanticui-calendar/calendar.min.js')}}"></script>
@append

@section('scripts')
@include('modules.master.policy.script.datatable')
<script>
	$(document).ready(function() {
		$('.search.dropdown').addClass('six wide column')
		user = $('#userTable').DataTable({
			dom: 'rt<"bottom"ip><"clear">',
			responsive: true,
			autoWidth: false,
			processing: true,
			serverSide: true,
			lengthChange: false,
			pageLength: 10,
			filter: false,
			bDestroy: true,
			sorting: [],
			language: {
				url: "{{ asset('plugins/datatables/indonesian.json') }}"
			},
			ajax:  {
				url: "{{ url($pageUrl) }}/grid-user",
				type: 'POST',
				data: function (d) {
				d._token = "{{ csrf_token() }}";
				d.bulletin_id = "{{ $record->id }}";
				d.username = $('input[name="filter[username]"]').val();
				d.reviewed = $('select[name="filter[reviewed]"]').val();
				}
			},
			columns: {!! json_encode($userStruct) !!},
			drawCallback: function() {
				var api = this.api();
				api.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				start = cell.innerHTML;
				cell.innerHTML = (parseInt(start) + (i+1));
				});

				$('[data-content]').popup({
				hoverable: true,
				position : 'top center',
				delay: {
					show: 300,
					hide: 800
				}
				});

				//Popup
				$('.checked.checkbox')
				.popup({
					popup : $('.custom.popup'),
					on    : 'click'
				})
				;
			}
		});
  	});

	$(document).on('click', '.ui.icon.filter.button', function () {
		user.draw();
	})

	$(document).on('click', '.ui.icon.reset.button', function () {
		$('input[name^="filter"]').each(function (index, value) {
			$(value).val('');
		})
		user.draw();
	});
</script>
@append
@section('styles')
    <style>
    .ui.ribbon.label {
        margin-right: 0;
        padding-left: 0;
        padding-right: 0;
        position: initial;
    }
</style>
@endsection
@section('content-header')
<h2 class="ui header">
	<div class="content">
		{!! $title or '' !!}
	</div>
</h2>
@endsection

@section('content-body')
<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
	<div class="ui top attached segment">
		<div class="ui grid form">
			<div class="sixteen wide column">
				<h1 class="ui header">
					<img src="{!! asset('img/icon-long.png') !!}" class="ui circular image">
					<div class="content">
					{!! $record->title !!}
					<div class="sub header">{!! Helpers::DateToString($record->date_induction_start).' - '.Helpers::DateToString($record->date_induction_end) !!}</div>
					</div>
				</h1>
				<div class="ui divider"></div>
				<form class="ui filter form">
					<div class="inline fields">
						<div class="field">
							<input name="filter[username]" placeholder="username" type="text">
						</div>
						<div class="field">
						  <select name="filter[reviewed]" class="ui search dropdown">
						    <option value="">(Choose view status)</option>
						    <option value="2">Has been Induction</option>
						    <option value="1">Haven't Joined the Induction yet</option>
						    <option value="0">Failed Follow Induction</option>
						  </select>
						</div>
						<button type="button" class="ui icon filter button" data-content="Cari Data">
							<i class="search icon"></i>
						</button>
						<button type="reset" class="ui icon reset button" data-content="Bersihkan Pencarian">
							<i class="refresh icon"></i>
						</button>
						<div class="field" style="padding-left: 50px">
							<h5 class="ui header">Has been Induction = {!! $record->getHasbeenInductionCount()  !!}</h5>
						</div>
						{{-- <div class="field">
							<h5 class="ui header">Failed Follow Induction = {!! $record->getFailedCount()  !!}</h5>
						</div> --}}
						<div class="field">
							<h5 class="ui header">Haven't Joined the Induction yet = {!! $record->getHaventJoinedCount()  !!}</h5>
						</div>
						
					</div>
				</form>
				<table id="userTable" class="ui celled compact table" width="100%" cellspacing="0">
					<thead>
						<tr>
							@foreach ($userStruct as $struct)
								<th class="center aligned">{{ $struct['label'] or $struct['name'] }}</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						@yield('tableBody')
					</tbody>
				</table>
      </div>
		</div>
	</div>
	<div class="ui botttom attached segment">
		<div class="ui two column grid">
			<div class="left aligned column">
				<a class="ui labeled icon button" href="{{ url($pageUrl) }}">
					<i class="chevron left icon"></i>
					Back
				</a>
			</div>
		</div>
	</div>
</form>
@endsection
@section('init-modal')
<script>
 initModal = function(){
	$('.menu .item').tab();
	$(document).ready(function () {
	});
 }
</script>
@endsection