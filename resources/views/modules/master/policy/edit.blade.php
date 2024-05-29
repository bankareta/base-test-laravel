@extends('layouts.form')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">
@append

@section('js')
<script src="{{ asset('plugins/semanticui-calendar/calendar.min.js')}}"></script>
@append
@section('scripts')
<script>
	$(document).on('click', '.ui.red.icon.button.hapus-file-custom', function(e){
	var id = $(this).data('id');
	var hta = `
		<input type="hidden" name="file_deleted_id[]" placeholder="Title" value="`+id+`">
	`;
	$('.showfile'+id).html('');
	$('.showfile'+id).html(hta);
});
</script>
@endsection


@section('content-body')
<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
	<div class="ui top attached segment">
		<div class="ui form">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<input type="hidden" name="status" value="{{ $record->status }}">
			<div class="two fields">
				<div class="field">
					{{-- <label>{{trans('translator.Judul')}}</label> --}}
					{{-- <input type="text" name="title" placeholder="{{trans('translator.Judul')}}"> --}}
					<label>Title</label>
					<input type="text" name="title" placeholder="Title" value="{{ $record->title or '' }}">
				</div>
				<div class="field">
					<label>Company</label>
					@if (isset($record->site_id))
						<select id="site_id" name="site_id[]" class="ui fluid search dropdown" multiple>
							{!! App\Models\Master\Site::options('name','id',['selected' => $record->site_id], 'Choose One') !!}
						</select>
					@else
						<select id="site_id" name="site_id[]" class="ui fluid search dropdown" multiple>
							{!! App\Models\Master\Site::options('name','id',['selected' =>
							$record->site->pluck('id')->toArray()
							], 'Choose One') !!}
						</select>
					@endif
				</div>
			</div>
			<div class="field">
		    {{-- <label>{{trans('translator.Konten')}}</label>
		    <textarea name="content" placeholder="{{trans('translator.Konten')}}" class="summernote"></textarea> --}}
		    <label>Contents</label>
		    <textarea name="content" placeholder="Contents" class="summernote">{!! $record->content or '' !!}</textarea>
		</div>
		<div class="two fields">
			<div class="field">
				<label>Policy & Procedure Type</label>
				<select id="site_id" name="type_id" class="ui fluid search dropdown">
					{!! App\Models\Master\TipePolicy::options('name','id',[
						'selected' => $record->type_id
					], 'Choose One') !!}
				</select>
			</div>
			<div class="field">
					<label>Reference Files</label>
					<div class="ui action input">
						<input type="text" name="fileupload" placeholder="Search..." readonly>
						<input type="file" style="display:none !important;" accept="image/*, video/mp4, application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/msword, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-excel, application/vnd.ms-powerpoint" multiple>
						<button class="ui button browse file">Cari..</button>
					</div>
				</div>
		</div>
		<div class="field showbrowse file">
			@if($record->lampiranberkas->count() > 0)
				@foreach($record->lampiranberkas as $file)
					<div class="two fields bedebahs-file">
						<div class="fourteen wide field">
							<div class="ui progress success" data-percent="100">
								<div class="bar" style="transition-duration: 300ms; width: 100%;">
									<div class="progress">100%</div>
								</div>
								<div class="label">{!! $file->filename !!}</div>
							</div>
						</div>
						<div class="two wide field">
							<a href="{{ asset('storage/'.$file->url) }}" target="_blank" download="{{ $file->filename }}" class="ui icon green button">
								<i class="download icon"></i>
							</a>
							<button class="ui icon red removebrowse button">
								<i class="trash icon"></i>
							</button>
							<input name="fileid[]" value="{!! $file->id !!}" type="hidden">
							<input name="filespath[]" value="{!! $file->url !!}" type="hidden">
							<input name="fileurl[]" value="{!! $file->url !!}" type="hidden">
							<input name="filename[]" value="{!! $file->filename !!}" type="hidden">
						</div>
					</div>
				@endforeach
			@endif
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
