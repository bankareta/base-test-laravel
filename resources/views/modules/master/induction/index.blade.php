@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('filters')
<div class="field">
		<div class="ui input left icon">
			<i class="search icon"></i>
			<input type="text" name="filter[material_name]"  placeholder="Title" value="">
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
d.material_name = $("input[name='filter[material_name]']").val();
@endsection

@section('scripts')
{{-- @include('modules.master.induction.script') --}}
<script>
$(document).on('change', 'input[name="file"]', function(f){
	var uploadurl = '{{ url($pageUrl.'upload') }}';
	var deleteurl = '{{ url($pageUrl.'removefile') }}';
	var csrftoken = '{{ csrf_token() }}';
	var extens = [
		'video/mp4', 'application/msword', 'application/pdf',
		'application/vnd.ms-powerpoint',
		'application/vnd.openxmlformats-officedocument.presentationml.presentation',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
	];
	var dataId = $(this).data('id');
	var progress = $('#progresBar'+dataId);
	var showFileName = $('label[class="show filename'+dataId+'"]');
	var his = $(this);
	var maxsize = {{Helpers::convertfilesize('induction')}};
	var success = [];
	var failed = [];
	var faileditem = '';
	var files = f.target.files[0];
	if(files.size > maxsize){
		swal(
			'Warning!',
			'File(s) is above {{ini_get('upload_max_filesize')}}B',
			'error'
		);
	}else{
		var str = files.name;
		var found = extens.find(function(element) { 
			return element == files.type; 
		}); 
		
		if(found){
			his.attr("disabled", true)
			showFileName.append(str.substring(0, 100));
			var payload = new FormData();
			payload.append('files', files);
			payload.append('_token', csrftoken)
			var xhr = new XMLHttpRequest();
			xhr.open('POST', uploadurl, true);
			xhr.upload.onprogress = function (e) {
				$(this).attr("disabled", true);
				if (e.lengthComputable) {
					progress.progress({
						total : e.total,
						value : e.loaded,
					})
				}
			}
			xhr.upload.onloadstart = function (e) {
				progress.progress({
					total : e.total,
					value : 0,
				})
			}
			xhr.upload.onloadend = function (e) {
				progress.progress({
					value : e.loaded,
				})
			}
			xhr.send(payload);
			xhr.onreadystatechange = function() {
				if(xhr.readyState == XMLHttpRequest.DONE)
				{
					var response = JSON.parse(xhr.responseText);
					if(response['url'] && response['filename'])
					{
						on_button = true;
						addLine = '';
						if( dataId == 1 ){
							addLine =`<button class="ui mini blue icon add-line-upload button" type="button"><i class="plus icon"></i></button>`;
						}
						setTimeout(function(){
							showFileName.find('p').html('');
							progress.progress('set success');
							progress.progress('set bar label', 'Upload Success');
							var showinput = $('.showInput'+dataId);
							showinput.append(`
								<input type="hidden" value="`+response['url']+`" name="fileurl[]">
							`);
							showinput.append(`
								<input type="hidden" value="`+response['filename']+`" name="filename[]">
							`);
							$('.fields.showing'+dataId).append(`<div class="two wide field showAction`+dataId+`" style="padding-left: 0px;padding-right: 0px;">
								<label class="show">&nbsp;&nbsp;</label>
								`+addLine+`
								<button class="ui mini red icon remove file mfs button" data-id="`+dataId+`" type="button"><i class="trash icon"></i></button>
							</div>`)
						}, 500)
					}else{
						progress.progress('set error');
						progress.progress('set bar label', 'Upload Failed');
					}
				}
			}
		}else{
			swal(
				'Warning!',
				'Format file must be MP4, Office document, Power point and PDF',
				'error'
			);
		}
	}
});

$(document).on('click', '.remove.file.mfs', function(f){
	var csrftoken = '{{ csrf_token() }}';
	var deleteurl = '{{ url($pageUrl.'removefile') }}';
	var dataId = $(this).data('id');
	var element = $('.mfs.fileupload').find('[data-id='+dataId+']');
	var showInput = $('.showInput'+dataId);
	var fileurl = showInput.find('input[name="fileurl[]"]').map(function(){return $(this).val();}).get();
	console.log(fileurl);
	var progress = $('#progresBar'+dataId);
	var payload = new FormData();
	var showFileName = $('label[class="show filename'+dataId+'"]');

	payload.append('_token', csrftoken)
	var TotalImages = fileurl.length;
	payload.append('fileurl', fileurl);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', deleteurl, true);
	xhr.send(payload);
	xhr.onreadystatechange = function() {
		if(xhr.readyState == XMLHttpRequest.DONE)
		{
			if(dataId == 1){
				showFileName.html('&nbsp;&nbsp;');
				$('.showAction'+dataId).remove();
				$('.showInput'+dataId).html('');
				progress.removeClass('success');
				progress.progress('reset');
				element.find('input[name="file"]').val('');
				element.find('input[name="file"]').attr("disabled", false);
			}else{
				element.remove();
			}
		}
	}
});

$(document).on('click', '.add-line-upload', function(f){
	lastID = $('.checkID').last().data('id');
	lastID = 1 + parseInt(lastID);
	var htm = `
		<div class="mfs fileupload" data-id="`+lastID+`" style="margin-bottom: -20px;">
			<div class="fields showing`+lastID+`" data-id="`+lastID+`">
				<div class="two wide field">
					<label>File</label>
					<button type="button" class="ui fluid small icon upload mfs file button" data-id="`+lastID+`">....</button>
					<input type="file" class="hidden mfs file upload" name="file" data-id="`+lastID+`" autocomplete="off" accept="video/mp4, application/pdf, application/msword,.doc, .docx,.ppt, .pptx, application/vnd.ms-powerpoint">
				</div>
				<div class="fourteen wide field">
					<label class="show filename`+lastID+`">&nbsp;&nbsp;</label>
					<div class="ui teal standard progress checkID" data-id="`+lastID+`" id="progresBar`+lastID+`">
						<div class="bar">
							<div class="progress"></div>
						</div>
					</div>
				</div>
				<div class="showInput`+lastID+`" data-id="`+lastID+`"></div>
			</div>
		</div>
	`;
	$('#fileArea').append(htm);
});
</script>
@endsection

@section('rules')
<script type="text/javascript">
</script>
@endsection

@section('toolbars')
	@can($pagePerms.'-add')
		<button type="button" class="ui gmf blue add button">
			<i class="plus icon"></i>
			Create New Data
		</button>
	@endcan
@endsection

@section('init-modal')
@include('modules.master.induction.script')
@endsection