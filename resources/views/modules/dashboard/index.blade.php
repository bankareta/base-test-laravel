@extends('layouts.base')

@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/tiny-slider/tiny-slider.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/nanoscroll/nanoscroller.css') }}">
	<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/projects.css') }}">
	<link href="{{ asset('plugins/glide/jeffry.in.slider.css') }}" rel="stylesheet">
@append

@section('js')
	<script src="{{ asset('plugins/tiny-slider/tiny-slider.js') }}"></script>
	<script src="{{ asset('plugins/nanoscroll/jquery.nanoscroller.js') }}"></script>
	<script src="{{ asset('plugins/chartjs/Chart.js') }}"></script>
    <script src="{{ asset('plugins/glide/jquery.glide.min.js') }}"></script>
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
	$('.slider').glide({
		autoplay: 5000,
		arrowsWrapperClass: 'slider-arrows',
		arrowRightText: '',
		arrowLeftText: ''
	});
</script>
@append


@section('content')
	{{-- @include('modules.dashboard.widgets.slider') --}}
	<div class="ui stackable equal width grid">
		<div class="ui center aligned segment" style="padding:0; overflow:hidden; height:275px;">
			<div class="slider slider1">
				<div class="slides">
					<div class="slide-item" style="position: relative">
						<img title="example" class="image-preview center aligned" id="showAttachment" style="width: 100%;" src="https://img.floweradvisor.com/b/33ee0e02a453d58b2c8710c0b271737c.webp?v=20240510131001">
					</div>
					<div class="slide-item" style="position: relative">
						<img title="example" class="image-preview center aligned" id="showAttachment" style="width: 100%;" src="https://img.floweradvisor.com/p/t/fa1a58f649ff48cb185a6b80d600ac33.webp?v=20231207165727">
					</div>
					<div class="slide-item" style="position: relative">
						<img title="example" class="image-preview center aligned" id="showAttachment" style="width: 100%;" src="https://img.floweradvisor.com/b/b56fc3dfa52402db936a44ab4af02515.webp?v=20240307180122">
					</div>
				</div>
			</div>
		</div>
		<div class="sixteen wide column">
			<div class="ui four stackable cards">
				<div class="ui orange card">
					<div class="content">
						<i class="right floated chart line large orange icon"></i>
						<div class="header">Monitoring</div>
					</div>
					<div class="extra content center aligned padded">
						<div class="ui two mini statistics">
							<div class="ui blue statistic">
								<div class="value">
									<a href="{{ url('/monitoring/visitor') }}">10</a>
								</div>
								<div class="label">
									<i class="mini">Visitor</i>
								</div>
							</div>
							<div class="ui yellow statistic">
								<div class="value">
									<a href="{{ url('/monitoring/whises') }}">30</a>
								</div>
								<div class="label">
									<i class="mini">Comment</i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="ui orange card">
					<div class="content">
						<i class="right floated chart line large orange icon"></i>
						<div class="header">Monitoring</div>
					</div>
					<div class="extra content center aligned padded">
						<div class="ui two mini statistics">
							<div class="ui blue statistic">
								<div class="value">
									<a href="{{ url('/monitoring/visitor') }}">10</a>
								</div>
								<div class="label">
									<i class="mini">Visitor</i>
								</div>
							</div>
							<div class="ui yellow statistic">
								<div class="value">
									<a href="{{ url('/monitoring/whises') }}">30</a>
								</div>
								<div class="label">
									<i class="mini">Comment</i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="ui orange card">
					<div class="content">
						<i class="right floated chart line large orange icon"></i>
						<div class="header">Monitoring</div>
					</div>
					<div class="extra content center aligned padded">
						<div class="ui two mini statistics">
							<div class="ui blue statistic">
								<div class="value">
									<a href="{{ url('/monitoring/visitor') }}">10</a>
								</div>
								<div class="label">
									<i class="mini">Visitor</i>
								</div>
							</div>
							<div class="ui yellow statistic">
								<div class="value">
									<a href="{{ url('/monitoring/whises') }}">30</a>
								</div>
								<div class="label">
									<i class="mini">Comment</i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="ui orange card">
					<div class="content">
						<i class="right floated chart line large orange icon"></i>
						<div class="header">Monitoring</div>
					</div>
					<div class="extra content center aligned padded">
						<div class="ui two mini statistics">
							<div class="ui blue statistic">
								<div class="value">
									<a href="{{ url('/monitoring/visitor') }}">10</a>
								</div>
								<div class="label">
									<i class="mini">Visitor</i>
								</div>
							</div>
							<div class="ui yellow statistic">
								<div class="value">
									<a href="{{ url('/monitoring/whises') }}">30</a>
								</div>
								<div class="label">
									<i class="mini">Comment</i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="sixteen wide column">
			<div class="ui segment">
				<h2 class="ui icon header">
					<a href="https://www.floweradvisor.com.ph/flowersphilippines" target="_blank" rel="noopener noreferrer">
						<img src="https://aldmic.com/images/flower-advisor-logo.png" class="image" style="width:16em">
					</a>
					<div class="content">
						<div class="sub header">Flowers are the perfect gift for any occasion or celebration. 
							Each color of a flower holds its own special meaning and symbolism. 
							At FlowerAdvisor, we make it easy for you to send flowers to Philippines and bridge the distances between you and your loved ones. 
							You can conveniently order flowers online and enjoy same-day flower delivery in Philippines from FlowerAdvisor. 
							Our wide selection includes roses, lilies, gerberas, orchids, gladiolus, and carnations, among others. 
							The exquisite beauty of flowers is certain to warm the heart of the recipient on special days like birthdays, 
							anniversaries, Valentine's Day, Mother's Day, and more. Our expert florists design stunning flower 
							arrangements and bouquets that are guaranteed to add joy to any occasion.</div>
					</div>
				</h2>
			</div>
		</div>
	</div>
@endsection
