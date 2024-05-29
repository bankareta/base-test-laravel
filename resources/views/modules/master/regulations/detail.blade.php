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
$(document).on('click', '.ui.file.input input:text, .ui.button', function(e) {
	$(e.target).parent().find('input:file').click();
});

function removePictureStandard() {

	var pathinput = $('input[name="attachment[]"]').serializeArray();
	var map = $.map(pathinput,function(v,k){
		return v.value;
	});
	console.log('map',map);
	var formData = new FormData();

	$.ajax({
		url: '{{ url('picture/bulk-unlink') }}',
		type: "POST",
		data : {"_token":'{{ csrf_token() }}','filedelete':map},
		beforeSend : function () {

		},
		success: function(resp){

		},
		error : function(resp){
		},
	});
}

$(document).on('change', '.ui.file.input input:file', function(e) {
	removePictureStandard();
	$('input[name="attachment[]"]').remove();
	$('.errors-files').remove();
	var file = $(e.target);
	var name = '';
	var pass = 0;
	var i = 0;
	var maxsize = {{Helpers::convertfilesize()}};
	var failed = [];
	var success = [];
	var formData = new FormData();
	formData.append('_token', '{{ csrf_token() }}');
	var url = $(this).data('url');

	if(e.target.files.length > 0){
		var html = '<div class="ui red message errors-files">';
		$.each(e.target.files, function (index, filee) {
			var showclass = "success";

			if(filee.size > maxsize)
			{
				html += '<span style=""><i class="exclamation alternate icon"></i>Sorry File '+ filee.name +' ( Failed to upload size above '+ "{{ini_get('upload_max_filesize')}}" +'B )</span><br>';
				failed.push(filee.name);
				i++;
				pass = i;
			}else{
				formData.append('picture['+index+']', filee);
				success.push(filee.name);
				name += filee.name + ', ';
			}
		});
		console.log('pass',pass)
		html+='</div>';
		if(pass > 0){
			$('#appendErrorFile').append(html);
		}
	}
// remove trailing ","
name = name.replace(/,\s*$/, '');
$('input:text', file.parent()).val(name);

if(success.length > 0){
	$.ajax({
		url: url,
		type: "POST",
		dataType: 'json',
		processData: false,
		contentType: false,
		timeout:15000,
		data : formData,
		success: function(resp){
			$.each(resp.url, function (index, value) {
				$('#attachment').append(`<input type="hidden" class="mfs path hidden input" name="attachment[]" value="`+ value +`"><input type="hidden" class="mfs path hidden input" name="filenames[]" value="`+ resp.filename[index] +`">`);
			})
		},
		error: function(resp){
			var response = resp.responseJSON;
			if(typeof response === 'undefined'){
				var messagefILE = 'Sorry your file is to large maximum uploaded {{ini_get('upload_max_filesize')}}B';
				swal(
					'Warning!',
					''+messagefILE,
					'error'
					);
			}
		},
	})
}

time = 5;
interval = setInterval(function(){
	time--;
	if(time == 0){
		clearInterval(interval);
		$('.errors-files').remove();
	}
},1500)
});
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
		Detail Regulation & Standards
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
					<input type="text" name="name" placeholder="Title" readonly value="{{ $record->name or '' }}">
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
				<textarea name="description" placeholder="Contents" readonly class="summernote">{!! $record->description or '' !!}</textarea>
			</div>
			<div class="two fields">
				<div class="field changeKelompok">
					<label>Category</label>
					<input type="text" name="name" placeholder="Title" readonly value="{{ ($record->type->type == 0) ? 'Regulations' : 'Standards' }}">
				</div>
				<div class="field">
					<label>Type</label>
					<input type="text" name="name" placeholder="Title" readonly value="{{ $record->type->name }}">
				</div>
			</div>
			<div class="field">
				<label>Attachment</label>
				{{-- <div class="two fields"> --}}
					{{-- <div class="ui inline grid field" >
						<div class="sixteen wide column" style="padding: .5rem 0" id="appendErrorFile">
						<div class="ui fluid file input action" >
							<input type="text" name="attachment_text" readonly>
							<input type="file" class="sixteen wide column"  autocomplete="off" multiple data-url="{{ url($pageUrl.'upload') }}" id="attachment">
							<div class="ui button file">
								Search...
							</div>
						</div>
					</div>
					</div> --}}
					<div class="ui segment">
						<div class="ui {{ ($record->file()->count() > 0) ? 'six':'one' }} column grid" data-id="{{ $record->id }}">
							@if ($record->file->count() > 0)
							    @foreach ($record->file as $file)
							    <div class="column" data-tooltip="{{ $file->filename }}">
							        <div class="ui fluid card" style="text-align: center;">
							            <div class="image" style="font-size: 5rem;padding-top: 0.2em">
											<a class="image" href="{{ asset('storage/'.$file->fileurl) }}" download="{{ $file->filename }}" target="_blank">
												<img class="image-preview center aligned" id="showAttachment" style="width: 100%;height: 100px;" src="{{ Helpers::showImgExtension($file->fileurl,true) }}">
											</a>
							            </div>
							            <div class="content">
							                <p>{{ substr($file->filename,0,6) }}...</p>
							            </div>
							        </div>
							    </div>
							    @endforeach
							@else
							    <div class="column">
							        <div class="ui fluid card" style="text-align: center;">
							            <div class="image" style="font-size: 5rem;padding-top: 0.2em">
							                <i class="large file icon"></i>
							            </div>
							            <div class="content">
							                <p>No file Uploaded</p>
							            </div>
							        </div>
							    </div>
							@endif
						</div>
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
	            {{-- <div class="ui positive right labeled icon save as page button">
	                Save
	                <i class="checkmark icon"></i>
	            </div> --}}
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
