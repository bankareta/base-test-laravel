@extends('layouts.list')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">
@append

@section('js')
<script src="{{ asset('plugins/semanticui-calendar/calendar.min.js')}}"></script>
@append

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
					 <select id="site_id" name="site_id[]" class="ui fluid search dropdown multiple" multiple>
		            {!! App\Models\Master\Site::options('name','id',[], 'Choose One') !!}
		          </select>
				</div>
			</div>
		  <div class="field">
		    <label>Contents</label>
		    <textarea name="content" placeholder="Contents" class="summernote"></textarea>
		  </div>
			<div class="two fields">
				<div class="field">
					<label>Policy & Procedure Type</label>
					<select id="site_id" name="type_id" class="ui fluid search dropdown">
						{!! App\Models\Master\TipePolicy::options('name','id',[], 'Choose One') !!}
					</select>
				</div>
				<div class="field">
					<label>Reference Files</label>
					<div class="ui action input">
						<input type="text" name="fileupload" placeholder="Search..."  readonly>
						<input type="file" style="display:none !important;" accept="image/*, video/mp4, application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/msword, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-excel, application/vnd.ms-powerpoint" multiple>
						<button class="ui button browse file">Cari..</button>
					</div>
				</div>
			</div>
			<div class="field showbrowse file">
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
