@extends('layouts.base')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/tiny-slider/tiny-slider.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/nanoscroll/nanoscroller.css') }}">
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/projects.css') }}">
@append

@section('js')
<script src="{{ asset('plugins/tiny-slider/tiny-slider.js') }}"></script>
<script src="{{ asset('plugins/nanoscroll/jquery.nanoscroller.js') }}"></script>
<script src="{{ asset('plugins/chartjs/Chart.js') }}"></script>
@append

@section('styles')
<style type="text/css">
.monitoring.list > .item{
	padding: 1rem !important;
}
.ui.card > .extra, .ui.cards > .card > .extra {
	min-height: auto !important;
}
.list-container {
	min-height: 300px;
}
.ui.feed > .event > .content .extra.text .date {
	display: inline-block;
	float: none;
	font-weight: 400;
	font-size: .85714286em;
	font-style: normal;
	margin: 0 0 0 .5em;
	padding: 0;
	color: rgba(0,0,0,.4);
}
.ui.feed .ui.list > .item > i.icon{
	display: inline-block
}
.red.item{
	-moz-box-shadow:    inset 0 0 5px #db2828;
	-webkit-box-shadow: inset 0 0 5px #db2828;
	box-shadow:         inset 0 0 5px #db2828;
}
</style>
@append

@section('scripts')
<script type="text/javascript">
$(document).ready(function($) {
	$('.ui.progress').progress({
		duration : 200,
		total    : 100,
	});

	$('.item').popup({
		position: 'left center'
	});

	var ctx = $('#wpChart');

	data = {
		datasets: [{
			backgroundColor: ["#ffce56", "#db2828", "#21ba45"],
				// data:
				{{-- // data: {!! $wp_stats !!} --}}
			}],
			// These labels appear in the legend and in the tooltips when hovering different arcs
			labels: [
			'Progress',
			'Pending',
			'Done'
			]
		};
		var textX = 0;
		var textY = 0;
		var text = 0;
	});

var landscape = $('#majeureLandscape').modal('setting', {
	onShow : function () {
		$(this).css({
			'margin-top' : '0',
			'margin' : '0',
			'position' : 'fixed',
			'top' : '0',
			'bottom' : '0',
			'left' : '0',
			'right' : '0',
			'width' : 'auto'
		});

		$(this).removeClass('scrolling');
	}
});

var portrait = $('#majeurePortrait').modal('setting', {
	onShow : function () {
		$(this).css({
			'margin-top' : '0',
			'margin' : '0',
			'position' : 'fixed',
			'top' : '0',
			'bottom' : '0',
			'left' : '0',
			'right' : '0',
			'width' : 'auto'
		});

		$(this).removeClass('scrolling');
	}
});

$(document).on('click', '.landscape.button', function(e){
	landscape.modal('show');
	GoInFullscreen($('#majeureLandscape').get(0));
});

$(document).on('click', '.portrait.button', function(e){
	portrait.modal('show');
	GoInFullscreen($('#majeurePortrait').get(0));
});

$(document).on('click', '.pelaksana.button', function(e){
	var id  = $(this).data('id');
	var url = "{{ url('wp/monitoring') }}/"+id+"/edit";

	$('#pelaksanaModal').modal({
			inverted: true, // ver.1 background modal white
			observeChanges: true,
			onShow: function(){
				$(this).draggable({
					cancel: ".content"
				});

				$.get(url, { _token: "{{ csrf_token() }}" } )
				.done(function( response ) {
					$('#pelaksanaModal').html(response);
					var slider = tns({
						container: '.workers',
						items: 3,
						mouseDrag: true,
						autoplay: false,
						loop: false,
						controlsContainer: "#customize-controls",
						nav: true,
					});
				});
			},
			onHidden: function(){
				$('#pelaksanaModal').html(`<div class="ui inverted loading dimmer">
					<div class="ui text loader">Loading</div>
					</div>`);
				dismissModal();
			}
		}).modal('show');
});

$(document).on('click', '.progress.button', function(e){
	var id  = $(this).data('id');
	var url = "{{ url('wp/monitoring') }}/"+id;

	$('#progressModal').modal({
			inverted: true, // ver.1 background modal white
			observeChanges: true,
			onShow: function(){
				$(this).draggable({
					cancel: ".content"
				});

				$.get(url, { _token: "{{ csrf_token() }}" } )
				.done(function( response ) {
					$('#progressModal').html(response);
					var slider = tns({
						container: '.workers',
						items: 3,
						mouseDrag: true,
						autoplay: false,
						loop: false,
						controlsContainer: "#customize-controls",
						nav: true,
					});
				});
			},
			onHidden: function(){
				$('#progressModal').html(`<div class="ui inverted loading dimmer">
					<div class="ui text loader">Loading</div>
					</div>`);
				dismissModal();
			}
		}).modal('show');
});

$(document).on('fullscreenchange webkitfullscreenchange mozfullscreenchange MSFullscreenChange', function() {
	if(!IsFullScreenCurrently()){
		$('#majeureLandscape').modal('hide');
		$('#majeurePortrait').modal('hide');
	}
});
</script>
@append

@section('addmore')
<script type="text/javascript">
var loading = `<div class="ui active inverted dimmer">
<div class="ui loader"></div>
</div>`;
$(document).ready(function () {
	$('.tabular.menu .item:first').trigger('click');
});

$('.tabular.menu .item')
.tab({
	onLoad : function (e,f,g) {
		var element = $(this);

		$.ajax({
			url: '{{ url('/show-data')  }}/' + element.data('tab'),
			type: "GET",
			beforeSend : function () {
				element.html(loading)
			},
			success: function(resp){
				element.html(resp)
				loadGraphic(element.data('tab'))
			},
			error : function(resp){
			},
		})
	},
})
;

</script>
@append

@section('content')
@if(auth()->user()->roles->count() > 0)
@include('modules.dashboard.widgets.slider')
@if (auth()->user())
<div class="ui three cards">
	<div class="ui orange card">
		<div class="content">
			<i class="right floated file text large orange icon"></i>
			<div class="header">Hazard / Near Miss</div>
		</div>
		<div class="extra content center aligned padded">
			<div class="ui four mini statistics">
				<div class="ui blue statistic">
					<div class="value">
						{!! $hazard->where('published', 0)->count() !!}
					</div>
					<div class="label">
						<i class="small">On Report</i>
					</div>
				</div>
				<div class="ui yellow statistic">
					<div class="value">
						{!! $hazard->where('published', 1)->count() !!}
					</div>
					<div class="label">
						<i class="small">On Monitoring</i>
					</div>
				</div>
				<div class="ui red statistic">
					<div class="value">
						{!! $hazard->where('published', 2)->count() !!}
					</div>
					<div class="label">
						<i class="small">On Action</i>
					</div>
				</div>
				<div class="ui green statistic">
					<div class="value">
						{!! $hazard->where('published', 3)->count() !!}
					</div>
					<div class="label">
						<i class="small">Closed</i>
					</div>
				</div>
			</div>
		</div>
		<div class="extra content center aligned">
			<div class="ui statistic">
				<div class="value">
					{!! $hazard->count() !!}
				</div>
				<div class="label">
					Total
				</div>
			</div>
		</div>
	</div>
	<div class="ui yellow card">
		<div class="content">
			<i class="right floated sliders horizontal large yellow icon"></i>
			<div class="header">HIRA</div>
		</div>
		<div class="extra content center aligned padded">
			<div class="ui five mini statistics">
				<div class="ui teal statistic">
					<div class="value">
						{!! $hira->where('position', 0)->count() !!}
					</div>
					<div class="label">
						<i class="mini">On Analysis</i>
					</div>
				</div>
				<div class="ui blue statistic">
					<div class="value">
						{!! $hira->where('position', 1)->count() !!}
					</div>
					<div class="label">
						<i class="mini">On Imitigation</i>
					</div>
				</div>
				<div class="ui red statistic">
					<div class="value">
						{!! $hira->where('position', 2)->count() !!}
					</div>
					<div class="label">
						<i class="mini">On Review</i>
					</div>
				</div>
				<div class="ui green statistic">
					<div class="value">
						{!! $hira->where('position', 3)->count() !!}
					</div>
					<div class="label">
						<i class="mini">On Approval</i>
					</div>
				</div>
				<div class="ui green statistic">
					<div class="value">
						{!! $hira->where('position', 4)->count() !!}
					</div>
					<div class="label">
						<i class="mini">Closed</i>
					</div>
				</div>
			</div>
		</div>
		<div class="extra content center aligned">
			<div class="ui statistic">
				<div class="value">
					{!! $hira->count() !!}
				</div>
				<div class="label">
					Total
				</div>
			</div>
		</div>
	</div>
	<div class="ui red card">
		<div class="content">
			<i class="right floated warning large red icon"></i>
			<div class="header">Accident</div>
		</div>
		<div class="extra content center aligned padded">
			<div class="ui four mini statistics">
				<div class="ui teal statistic">
					<div class="value">
						{!! $accident->where('status', 0)->count() !!}
					</div>
					<div class="label">
						<i class="mini">On Report</i>
					</div>
				</div>
				<div class="ui blue statistic">
					<div class="value">
						{!! $accident->where('status', 1)->count() !!}
					</div>
					<div class="label">
						<i class="mini">On Review</i>
					</div>
				</div>
				<div class="ui red statistic">
					<div class="value">
						{!! $accident->where('status', 2)->count() !!}
					</div>
					<div class="label">
						<i class="mini">On Approval</i>
					</div>
				</div>
				<div class="ui green statistic">
					<div class="value">
						{!! $accident->where('status', 4)->count() !!}
					</div>
					<div class="label">
						<i class="mini">Closed</i>
					</div>
				</div>
			</div>
		</div>
		<div class="extra content center aligned">
			<div class="ui statistic">
				<div class="value">
					{!! $hira->count() !!}
				</div>
				<div class="label">
					Total
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ui top attached segment">
	{{-- @if($record->count() > 0) --}}
	<div class="ui feed">
		@php
		$arr = [];
		$msg = '';
		$i = -1;
		$url = '';
		$userId = '';
		$modul = '';
		

		@endphp
		@foreach($record as $k => $value)

		@php
		$reportNo = '';
		if(isset($value[0]['no_report'])){
			$reportNo = 'with report number <p style="padding-left:19px">'.$value[0]['no_report'].'</p>';
		}

		if(count($value) > 0){
			if(count($value) > 1){
				$msg = 'You have <div class="ui red circular label">'.count($value).'</div> notification from '.$k.'<p><div class="date"><i class="ui clock icon"></i>'.$value[0]['created_at'].'</div></p>';
			}else{
				$msg = 'There is notification from '.$k.' '.$reportNo.' <p><div class="date"><i class="ui clock icon"></i>'.$value[0]['created_at'].'</div></p>';
			}
			$url = $value[0]['fullurl'];
			$userId = $value[0]['user_id'];
			$modul = $value[0]['modul'];	
		}
		@endphp
		<div class="event">
			<div class="label">
				<i class="ui {{ (count($value) > 0) ? $value[0]['icon'] : 'eye' }} icon" style="background-color:#009FDA"></i>
			</div>
			<div class="content">
				<div class="extra text">
					<a href="javascript:void(0)" class="ampasClick" data-href="{{$url}}" data-id="{{$userId}}" data-modul="{{$modul}}">{!! $msg !!}</a>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>

@endif
@else
<div class="ui massive message">
	<div class="header">
		You dont have privileges to enter this website	!
	</div>
	<p>Contact <b>administrator</b> to active and give privileges to your account.</p> <a href="{{ route('logout') }}">
	Logout
</a>
</div>
@endif
@endsection
