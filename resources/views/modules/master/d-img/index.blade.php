@extends('layouts.list')

@section('css')
	<link href="{{ asset('plugins/glide/jeffry.in.slider.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
	<script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
    <script src="{{ asset('plugins/glide/jquery.glide.min.js') }}"></script>
@append

@section('filters')
<div class="field">
		<div class="ui input left icon">
			<i class="search icon"></i>
			<input type="text" name="filter[name]"  placeholder="Filename" value="">
		</div>
</div>

<button type="button" class="ui teal icon filter button" data-content="Find Data">
	<i class="search icon"></i>
</button>
<button type="reset" class="ui icon reset button" data-content="Clear Search">
	<i class="refresh icon"></i>
</button>
@endsection

@section('js-filters')
d.name = $("input[name='filter[name]']").val();
d.status = $("select[name='filter[status]']").val();
@endsection

@section('scripts')
<script type="text/javascript">
	$('.slider').glide({
		autoplay: 5000,
		arrowsWrapperClass: 'slider-arrows',
		arrowRightText: '',
		arrowLeftText: ''
	});
</script>
@endsection


@section('rules')
<script type="text/javascript">
	formRules = {
		judul: 'empty',
		sub_judul: 'empty',
		url: 'url',
	};
</script>
@endsection

@section('content-body-footer')
@if ($file->count() > 0)
	<div class="ui center aligned segment" style="padding:0; overflow:hidden; height:356px;">
		@if ($file->count() == 1)
			@foreach ($file as $item)
				<div class="slide-item" style="position: relative">
					<img title="{{$item->filename}}" class="image-preview center aligned" id="showAttachment" style="width: 100%;margin-top: {{ $item->position ? '-'.($item->position + 25).'px':'0px' }}" src="{{ Helpers::checkExtFile($item->url) }}">
				</div>
			@endforeach
		@else
			<div class="slider slider1">
				<div class="slides">
					@foreach ($file as $item)
						<div class="slide-item" style="position: relative">
							<img title="{{$item->filename}}" class="image-preview center aligned" id="showAttachment" style="width: 100%;margin-top: {{ $item->position ? '-'.($item->position + 25).'px':'0px' }}" src="{{ Helpers::checkExtFile($item->url) }}">
						</div>
					@endforeach
				</div>
			</div>
		@endif
	</div>
@endif
@endsection

@section('init-modal')
@include('modules.master.d-img.action')
@endsection
