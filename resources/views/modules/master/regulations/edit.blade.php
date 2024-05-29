@extends('layouts.form')

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
		Edit Regulations & Standards
	</div>
</h2>
@endsection

@section('content-body')
<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
	<div class="ui top attached segment">
		<div class="ui form">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<input type="hidden" name="type_id" value="{{ $record->type_id or '' }}">
			<input type="hidden" name="status" value="{{ $record->status }}">
			{{-- <div class="two fields"> --}}
				<div class="field">
					<label>Title</label>
					<input type="text" name="name" placeholder="Title" value="{{ $record->name or '' }}">
				</div>
				{{-- <div class="field">
					<label>Company</label>
					<select id="site_id" name="site_ids[]" class="ui fluid search dropdown" multiple>
						{!! App\Models\Master\Site::options('name','id',['selected' =>
							$record->site->pluck('id')->toArray()
							], 'Choose One') !!}
					</select>
				</div> --}}
			{{-- </div> --}}
			<div class="field">
				<label>Contents</label>
				<textarea name="description" placeholder="Contents" class="summernote">{!! $record->description or '' !!}</textarea>
			</div>
			<div class="two fields">
				<div class="field changeKelompok">
					<label>Category</label>
					<select id="kelompok" name="kelompok" class="ui fluid dropdown selection search childs targets" data-child="getType">
						<option value="">Choose One</option>
						<option value="0" {{ ($record->type->type == 0) ? 'selected' : '' }}>Regulations</option>
						<option value="1" {{ ($record->type->type == 1) ? 'selected' : '' }}>Standards</option>
					</select>
				</div>
				<div class="field changeType">
					<label>Type</label>
					<select name="type_id" id="getType" class="ui fluid dropdown selection search">
						{!! App\Models\Master\TypeRegulationsStandard::options('name','id',['selected' => ['id' => $record->type_id],'filters' => ['type' => $record->type->type]],'Choose One') !!}
					</select>
				</div>
			</div>
			<div class="field">
				<label>Attachment</label>
				{{-- <div class="two fields"> --}}
					<div class="ui inline grid field" >
						<div class="sixteen wide column" style="padding: .5rem 0" id="appendErrorFile">
						<div class="ui fluid file input action"  id="attachment">
							<input type="text" name="attachment_text" readonly>
							<input type="file" class="sixteen wide column"  autocomplete="off" multiple data-url="{{ url($pageUrl.'upload') }}">
							<div class="ui button file">
								Search...
							</div>
						</div>
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
	          @if($record->file->count() > 0)
	            @foreach($record->file as $file)
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
	                  <a href="{{ asset('storage/'.$file->fileurl) }}" target="_blank" download="{{ $file->filename }}" class="ui icon green button">
	                    <i class="download icon"></i>
	                  </a>
	                  <button class="ui icon red removebrowse button">
	                    <i class="trash icon"></i>
	                  </button>
	                  <input name="fileid[]" value="{!! $file->id !!}" type="hidden">
	                  <input name="filespath[]" value="{!! $file->fileurl !!}" type="hidden">
	                  <input name="fileurl[]" value="{!! $file->fileurl !!}" type="hidden">
	                  <input name="filename[]" value="{!! $file->filename !!}" type="hidden">
	                </div>
	              </div>
	              @endforeach
	            @endif
	        </div>
				{{-- </div> --}}
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
$(document).on('change', '.childs.targets', function () {
		var elemchild = $(this).find('select').data('child');
		var id = $(this).find('select').val();
		if(!id){
			id = '-';
		}
		showLoadingInput(elemchild);
		if(id != null)
		{
			$.ajax({
				url: '{{ url("option") }}/'+ elemchild +'/'+ id,
				type: 'GET',
				success: function(resp){
					stopLoadingInput(elemchild);
					$('#'+elemchild).html(resp);
					$('#getType').dropdown('set selected', '{{ $record->type_id or '' }}');
				},
				error : function(resp){

				}
			});
		}
	});
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
