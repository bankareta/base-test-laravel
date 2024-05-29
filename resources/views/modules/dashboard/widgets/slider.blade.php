@section('css')
    <link href="{{ asset('plugins/glide/jeffry.in.slider.css') }}" rel="stylesheet">
@append

@section('js')
    <script src="{{ asset('plugins/glide/jquery.glide.min.js') }}"></script>
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

<div class="ui center aligned segment" style="padding:0; overflow:hidden; height:356px;">
	@if ($file->count() > 0)
		@if ($file->count() == 1)
			@foreach ($file as $item)
				<img title="{{$item->filename}}" class="image-preview center aligned" id="showAttachment" style="width: 100%;margin-top: {{ $item->position ? '-'.($item->position + 25).'px':'0px' }}" src="{{ Helpers::checkExtFile($item->url) }}">
			@endforeach
		@else
			<div class="slider slider1">
				<div class="slides">
					@foreach ($file as $item)
						@if(file_exists(storage_path().'/app/public/'.$item->url))
							<div class="slide-item">
								<img class="image-preview center aligned" id="showAttachment" style="width: 100%;margin-top: {{ $item->position ? '-'.($item->position + 25).'px':'0px' }}" src="{{ Helpers::checkExtFile($item->url) }}">
							</div>
						@endif
					@endforeach
				</div>
			</div>
		@endif
	@else
		<img class="image-preview center aligned" id="showAttachment" style="width: 100%;" src="{{ asset('img/no-images-landscape.png') }}">
	@endif
</div>
