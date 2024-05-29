@extends('layouts.list')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">
@append

@section('js')
<script src="{{ asset('plugins/semanticui-calendar/calendar.min.js')}}"></script>
@append

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
		Create New Regulations & Standards
	</div>
</h2>
@endsection

@section('content-body')
<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
	<div class="ui top attached segment">
		<div class="ui form">
			{!! csrf_field() !!}
			<input type="hidden" name="status" value="0">
			{{-- <div class="two fields"> --}}
				<div class="field">
					<label>Title</label>
					<input type="text" name="name" placeholder="Title">
				</div>
				{{-- <div class="field">
					<label>Company</label>
					<select id="site_id" name="site_ids[]" class="ui fluid search dropdown" multiple>
						{!! App\Models\Master\Site::options('name','id',[], 'Choose One') !!}
					</select>
				</div> --}}

			{{-- </div> --}}
			<div class="field">
				<label>Contents</label>
				<textarea name="description" placeholder="Content" class="summernote"></textarea>
			</div>
			<div class="two fields">
				<div class="field changeKelompok">
					<label>Category</label>
					<select id="kelompok" name="kelompok" class="ui fluid dropdown selection search child target" data-child="getType">
						<option value="">Choose One</option>
						<option value="0">Regulations</option>
						<option value="1">Standards</option>
					</select>
				</div>
				<div class="field changeType">
					<label>Type</label>
					<select name="type_id" id="getType" class="ui fluid dropdown selection search">
						<option value="">Choose One</option>

					</select>
				</div>
			</div>
			<div class="fourteen wide field">
				<label>Reference Files</label>
				<div class="ui action input">
					<input type="text" name="fileupload" placeholder="Search..." readonly>
					<input type="file" style="display:none !important;" accept="image/*, video/mp4, application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/msword, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-excel, application/vnd.ms-powerpoint" multiple>
					<button class="ui button browse file">Cari..</button>
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
					Back
				</div>
			</div>
			<div class="right aligned column">
        <div class="ui positive right labeled icon save as page button">
            Save
            <i class="checkmark icon"></i>
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
