@extends('layouts.list')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">
@append

@section('js')
<script src="{{ asset('plugins/daterangepicker/moment.js') }}"></script>
<script src="{{ asset('plugins/semanticui-calendar/calendar.min.js')}}"></script>
@append
@section('scripts')
<script>
</script>
@endsection

@section('content-header')
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
<h2 class="ui header">
	<div class="content">
		{{-- {{trans('translator.Buat')}} {!! trans('translator.'.$title) !!} --}}
		Create New Bulletin & Alert
	</div>
</h2>
@endsection

@section('content-body')
<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
	<div class="ui top attached segment">
		<div class="ui form">
			{!! csrf_field() !!}
			<input type="hidden" name="status" value="0">
			<div class="two fields">
			  <div class="field">
			    {{-- <label>{{trans('translator.Judul')}}</label> --}}
			    {{-- <input type="text" name="title" placeholder="{{trans('translator.Judul')}}"> --}}
			    <label>Title</label>
			    <input type="text" name="title" placeholder="Title">
			  </div>
			  	<div class="field">
					<label>Company</label>
					<select id="site_id" name="site_id[]" class="ui fluid search dropdown" multiple>
						{!! App\Models\Master\Site::options('name','id',[
							'filters' => [
								function ($site) {
										$site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
									},
								]
						], 'Choose One') !!}
					</select>
				</div>

			</div>
		  <div class="field">
		    {{-- <label>{{trans('translator.Konten')}}</label>
		    <textarea name="content" placeholder="{{trans('translator.Konten')}}" class="summernote"></textarea> --}}
		    <label>Contents</label>
		    <textarea name="content" placeholder="Contents" class="summernote"></textarea>
		  </div>
			<div class="two fields">
				<div class="field">
					{{-- <label>{{trans('translator.Tipe')}} {!! trans('translator.'.$title) !!} {{trans('translator.ini')}}?</label> --}}
					<label>Bulletin & Alert Type</label>
					<select id="site_id" name="type_id" class="ui fluid search dropdown">
						{!! App\Models\Master\TipeBulletin::options('name','id',[], 'Choose One') !!}
					</select>
				</div>

				<div class="field">
					{{-- <label>{{trans('translator.Lampiran')}}</label> --}}
					<label>Attachment</label>
					<div class="ui inline grid field" style="width: 100%">
    					<div class="sixteen wide column" style="padding: .5rem 0">
							<div class="ui fluid file input action">
								<input type="text" name="attachment_text" readonly>
								<input type="file" class="sixteen wide column"  name="attachment[]" autocomplete="off" multiple>
								<div class="ui button file">
									{{-- {{trans('translator.Cari')}}... --}}
									Search...
								</div>
								{{-- <button type="submit" class="ui button save as publicity teal" style="display:none;">Publish</button> --}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="ui botttom attached segment">
		<div class="ui two column grid">
			<div class="left aligned column">
				<div class="ui labeled icon button" onclick="goBack()">
					<i class="chevron left icon"></i>
					{{-- {{trans('translator.Kembali')}} --}}
					Back
				</div>
			</div>
			<div class="right aligned column">
				<div class="ui buttons">
					<button type="button" class="ui button save as draft positive">Draft</button>
					<div class="or"></div>
					<button type="button" class="ui button save as published">Publish</button>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection

@section('scripts')
<script type="text/javascript">
	var date = new Date();
	date.setDate(date.getDate() + 1);

	$('.ui.calendar').calendar({
		type: 'date',
		formatter: {
			date: function (date, settings) {
				let momentDate = new moment(date)
				return momentDate.format('DD/MM/YYYY')
			}
		},
		popupOptions: {
      position: 'center',
    },
	});
</script>
@append
