@extends('layouts.form')

@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">
@append

@section('js')
	<script src="{{ asset('plugins/semanticui-calendar/calendar.min.js')}}"></script>
@append

@section('scripts')
<script type="text/javascript">
$(document).ready(function () {
	$('.cards .dimmable.image').dimmer({
	  on: 'hover'
	});

	$('select[name="type_answer"]').on('change', function () {
			var multiple = `
				<table class="ui celled structured table">
					<tr>
						<td class="one wide">
							<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" name="true" value="1" checked>
								<label>A</label>
							</div>
							</div>
						</td>
						<td>
							<div class="field">
								<textarea name="answer[1]" class="transparent"></textarea>
							</div>
						</td>
						<td class="one wide">
							<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" name="true" value="2">
								<label>B</label>
							</div>
							</div>
						</td>
						<td>
							<div class="field">
								<textarea name="answer[2]" class="transparent"></textarea>
							</div>
						</td>
					</tr>
					<tr>
						<td class="one wide">
							<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" name="true" value="3">
								<label>C</label>
							</div>
							</div>
						</td>
						<td>
							<div class="field">
								<textarea name="answer[3]" class="transparent"></textarea>
							</div>
						</td>
						<td class="one wide">
							<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" name="true" value="4">
								<label>D</label>
							</div>
							</div>
						</td>
						<td>
							<div class="field">
								<textarea name="answer[4]" class="transparent"></textarea>
							</div>
						</td>
					</tr>
				</table>
					`;

			var boolean = `
			<table class="ui celled structured table">
				<tbody>
					<tr>
						<td class="one wide">
							<div class="field">
								<div class="ui radio checkbox">
									<input type="radio" name="true" value="1" checked>
									<label>True</label>
								</div>
								<input type="hidden" name="answer[1]" class="transparent" value="True">
							</div>
						</td>
						<td class="one wide">
							<div class="field">
								<div class="ui radio checkbox">
									<input type="radio" name="true" value="2" checked>
									<label>False</label>
								</div>
								<input type="hidden" name="answer[2]" class="transparent" value="False">
							</div>
						</td>
					</tr>
					</tbody>
				</table>
				`;
				if($(this).val() == 0)
				{
					$('td.answer_choose').html(multiple);
				}else if($(this).val() == 1)
				{
					$('td.answer_choose').html(boolean);
				}
	})
});
</script>
@include('modules.master.training.script.function')
@append

@section('content-body')
	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.'save-question') }}" method="POST">
		<div class="ui top attached segment">
			<div class="ui form">
				{!! csrf_field() !!}
				<input type="hidden" name="quiz_id" value="{{ $record->id }}">
				<table class="ui celled structured table">
        	<tbody>
						<tr class="active">
							<td class="two wide" colspan="4"><b>Add Question Image</b></td>
						</tr>
						<tr>
							<td colspan="4">
								<div class="ui cards">
									<div class="small card">
										<input type="file" class="hidden mfs multiple file input" name="picture[]" accept="image/*" data-url="{{ url($pageUrl.'question-uploads/') }}" multiple>
										<div class="blurring dimmable image">
											<div class="ui dimmer">
												<div class="content">
													<div class="center">
														<div class="ui blue icon large mfs multiple upload button"><i class="cloud upload icon"></i></div>
													</div>
												</div>
											</div>
											<img src="{{ asset('img/upload-image.png') }}">
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr class="active">
							<td colspan="4"><b>Question</b></td>
						</tr>
						<tr>
							<td colspan="4">
								<div class="field">
									<textarea name="question" class="transparent"></textarea>
	            	</div>
							</td>
						</tr>
						<tr class="active">
							<td colspan="3"><b>Answer</b></td>
							<td class="right aligned">
								<div class="field" style="width: 250px;">
									<select name="type_answer" class="ui search selection dropdown">
											<option value="">Choose type answer</option>
											<option value="0">Multiple Choice</option>
											<option value="1">True / False</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td class="answer_choose" colspan="4">
							</td>
						</tr>
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
