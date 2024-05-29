@extends('layouts.form')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">
@append

@section('js')
<script src="{{ asset('plugins/semanticui-calendar/calendar.min.js')}}"></script>
@append

@section('scripts')
<script type="text/javascript">
function mfsremovepictureexistbutton() {
		$(document).on('click','.mfs.remove.pictureexist.button', function () {
			var pathinput = $(this).parents('.card').find('.mfs.path.hidden.input').val();
			var elem = $(this);
			var loading = `<div class="ui active inverted dimmer">
			<div class="ui small text loader">Uploading... wait for a while..</div>
			</div>`;
      		elem.parent().remove();

			// var formData = new FormData();
			// formData.append('_token', '{{ csrf_token() }}');
			// formData.append('path', pathinput);

			// $.ajax({
			// 	url: '{{ url('picture/unlink') }}',
			// 	type: "POST",
			// 	dataType: 'json',
			// 	processData: false,
			// 	contentType: false,
			// 	beforeSend : function () {
			// 		elem.parents('.card').append(loading);
			// 	},
			// 	data : formData,
			// 	success: function(resp){
			// 		elem.parents('.card').remove();
			// 	},
			// 	error : function(resp){
			// 	},
			// })
		});
	}
$(document).ready(function () {
	mfsremovepictureexistbutton();

	$('.cards .dimmable.image').dimmer({
		on: 'hover'
	});

	$('.mfs.multiple.uploadexist.button').on('click', function () {
		$(this).parents('.small.card').find('.mfs.multiple.fileexist.input').trigger('click');
	});



	$('.mfs.multiple.fileexist.input').on('change', function (f) {
		var loading = `<div class="ui active inverted dimmer">
		<div class="ui small text loader">Uploading... wait for a while..</div>
		</div>`;

		var elem = $(this);
		var url = $(this).data('url');
		var files = f.target.files;
		var maxsize = {{Helpers::convertfilesize()}};
		var success = [];
		var failed = [];
		var faileditem = '';

		var formData = new FormData();
		formData.append('_token', '{{ csrf_token() }}');
		formData.append('question_id', '{{ $record->id }}');

		for(i = 0; i < files.length; i++)
		{
			if(files[i].size > maxsize)
			{
					failed.push(files[i].name);
			}else{
					formData.append('picture['+i+']', files[i]);
					success.push(files[i].name);
			}
		}

		console.log(failed.length)

		if(failed.length > 0)
		{
			 for(i = 0; i < failed.length; i++)
			 {
				 	faileditem += failed[i];
			 }
			 if(failed.length > 0)
			 {
				 if(success.length > 0)
				 {
					 swal({
					 	title: 'Warning',
					 	html: "There is " + failed.length + " (" + faileditem + ")" + " file(s) is above " + "{{ini_get('upload_max_filesize')}}" + "B, the file(s) will not be uploaded",
					 	type: 'warning',
					 	showCancelButton: true,
					 	confirmButtonColor: '#3085d6',
					 	confirmButtonText: 'Upload rest of file',
					 	cancelButtonColor: '#d33',
					 	cancelButtonText: 'Cancel Upload',
					 	reverseButtons: true,
					 }).then((result) => {
						 $.ajax({
						 	url: url,
						 	type: "POST",
						 	dataType: 'json',
						 	processData: false,
						 	contentType: false,
						 	timeout:150000,
						 	beforeSend : function () {
						 		elem.parents('.card').append(loading);
							 window.onbeforeunload = function(d) {
							 		return "Dude, are you sure you want to leave? Think of the kittens!";
							 }
						 	},
						 	data : formData,
						 	success: function(resp){
						 		$.each(resp.url, function (index, value) {
						 			elem.parents('.cards').append(`<div class="small card">
						 				<a class="image" href="` + value['url'] + `" target="_blank">
						 				<img src="`+ value['url'] +`" style="height:120px !important;">
						 				</a>
						 				<input type="hidden" class="mfs path hidden input" name="filespath[]" value="`+ value['value'] +`">
						 				<div class="ui bottom attached red mfs remove picture button">
						 				<i class="trash icon"></i>
						 				Remove Evidence
						 				</div>
						 				</div>`);
						 		})
						 		mfsremovepicturebutton();
						 		elem.parents('.cards').find('.ui.active.inverted.dimmer').remove();
						 	},
						 	error: function(resp){
						 	},
						 })
					 }, (dismiss) => {
						 swal(
						 	'Warning!',
						 	'Upload Canceled',
						 	'error'
						 	);
					 })
				 }else{
					 swal(
					 	'Warning!',
					 	'File(s) is above {{ini_get('upload_max_filesize')}}B',
					 	'error'
					 	);
				 }
			 }
		}else {
			$.ajax({
			 url: url,
			 type: "POST",
			 dataType: 'json',
			 processData: false,
			 contentType: false,
			 timeout:150000,
			 beforeSend : function () {
				 elem.parents('.card').append(loading);
				window.onbeforeunload = function(d) {
					 return "Dude, are you sure you want to leave? Think of the kittens!";
				}
			 },
			 data : formData,
			 success: function(resp){
				 $.each(resp.url, function (index, value) {
					 elem.parents('.cards').append(`<div class="small card">
						 <a class="image" href="` + value['url'] + `" target="_blank">
						 <img src="`+ value['url'] +`" style="height:120px !important;">
						 </a>
						 <input type="hidden" class="mfs path hidden input" name="filespath[]" value="`+ value['value'] +`">
						 <div class="ui bottom attached red mfs remove picture button">
						 <i class="trash icon"></i>
						 Remove Evidence
						 </div>
						 </div>`);
				 })
				 mfsremovepicturebutton();
				 elem.parents('.cards').find('.ui.active.inverted.dimmer').remove();
			 },
			 error: function(resp){
			 },
			})
		}
	});
});


</script>
@include('modules.master.training.script.function')
@append

@section('content-body')
<form class="ui data form" id="dataForm" action="{{ url($pageUrl.'edit-question') }}" method="POST">
	<div class="ui top attached segment">
		<div class="ui form">
			{!! csrf_field() !!}
			<input type="hidden" name="id" value="{{ $record->id }}">
			<table class="ui celled structured table">
				<tbody>
					<tr class="active">
						<td class="two wide" colspan="4"><b>Add Question Image</b></td>
					</tr>
					<tr>
						<td colspan="4">
							<div class="ui cards">
								<div class="small card">
									<input type="file" class="hidden mfs multiple fileexist input" name="picture[]" accept="image/*" data-url="{{ url($pageUrl.'images-exist-uploads/') }}" multiple>
									<div class="blurring dimmable image">
										<div class="ui dimmer">
											<div class="content">
												<div class="center">
													<div class="ui blue icon large mfs multiple uploadexist button"><i class="cloud upload icon"></i></div>
												</div>
											</div>
										</div>
										<img src="{{ asset('img/upload-image.png') }}">
									</div>
								</div>
								{!! $record->showCardImages() !!}
							</div>
						</td>
					</tr>
					<tr class="active">
						<td colspan="4"><b>Question</b></td>
					</tr>
					<tr>
						<td colspan="4">
							<div class="field">
								<textarea name="question" class="transparent">{!! $record->question !!}</textarea>
							</div>
						</td>
					</tr>
					<tr class="active">
						<td colspan="3"><b>Answer</b></td>
						<td class="right aligned">
							<div class="field" style="width: 250px;">
								<select name="type_answer" class="ui search selection dropdown">
										<option value="">Choose type answer</option>
										<option value="0" {{ $record->type_answer == 0 ? 'selected' : '' }}>Multiple Choice</option>
										<option value="1" {{ $record->type_answer == 1 ? 'selected' : '' }}>True / False</option>
								</select>
							</div>
						</td>
					</tr>
					@if($record->type_answer == 0)
						<tr>
							<td class="answer_choose" colspan="4">
								<table class="ui celled structured table">
									<tr>
										<td class="one wide">
											<div class="ui radio checkbox">
												<input type="radio" name="true" value="1" {{ $record->showTrue(1) == 1 ? 'checked' : '' }}>
												<label>A</label>
											</div>
										</td>
										<td>
											<div class="field">
												<textarea name="answer[{{ $record->showId(1) }}]" class="transparent"> {!! $record->showAnswer(1) !!}</textarea>
											</div>
										</td>
										<td class="one wide">
											<div class="ui radio checkbox">
												<input type="radio" name="true" value="2" {{ $record->showTrue(2) == 1 ? 'checked' : '' }}>
												<label>B</label>
											</div>
										</td>
										<td>
											<div class="field">
												<textarea name="answer[{{ $record->showId(2) }}]" class="transparent">{!! $record->showAnswer(2) !!}</textarea>
											</div>
										</td>
									</tr>
									<tr>
										<td class="one wide">
											<div class="ui radio checkbox">
												<input type="radio" name="true" value="3" {{ $record->showTrue(3) == 1 ? 'checked' : '' }}>
												<label>C</label>
											</div>
										</td>
										<td>
											<div class="field">
												<textarea name="answer[{{ $record->showId(3) }}]" class="transparent">{!! $record->showAnswer(3) !!}</textarea>
											</div>
										</td>
										<td class="one wide">
											<div class="ui radio checkbox">
												<input type="radio" name="true" value="4" {{ $record->showTrue(4) == 1 ? 'checked' : '' }}>
												<label>D</label>
											</div>
										</td>
										<td>
											<div class="field">
												<textarea name="answer[{{ $record->showId(4) }}]" class="transparent">{!! $record->showAnswer(3) !!}</textarea>
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					@else
						<tr>
							<td class="answer_choose" colspan="4">
							<table class="ui celled structured table">
								<tbody>
									<tr>
										<td class="one wide">
											<div class="field">
												<div class="ui radio checkbox">
													<input type="radio" name="true" value="1" {{ $record->showTrue(1) == 1 ? 'checked' : '' }}>
													<label>True</label>
												</div>
												<input type="hidden" name="answer[1]" class="transparent" value="True">
											</div>
										</td>
										<td class="one wide">
											<div class="field">
												<div class="ui radio checkbox">
													<input type="radio" name="true" value="2" {{ $record->showTrue(2) == 1 ? 'checked' : '' }}>
													<label>False</label>
												</div>
												<input type="hidden" name="answer[2]" class="transparent" value="False">
											</div>
										</td>
									</tr>
									</tbody>
								</table>
							</td>
						</tr>
					@endif
				</tbody>
			</table>
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
