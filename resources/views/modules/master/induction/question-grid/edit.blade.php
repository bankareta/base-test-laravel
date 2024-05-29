<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit Question Material Induction</div>
<div class="content">
    <form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">

		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">
		<input type="hidden" name="materi_id" value="{{ $id }}">
		<table class="ui celled structured table">
			<tbody class="show-answer">
				<tr class="active">
					<td class="two wide" colspan="4"><b>Edit Question Image</b></td>
				</tr>
				<tr>
					<td colspan="4" id="showFileExistDelete">
						<div class="ui centered cards">
							<div class="small card">
								<input type="file" class="hidden mfs multiple file-custom input" name="picture[]" accept="image/*" data-url="{{ url($pageUrl.'upload-img/') }}" multiple>
								<div class="blurring dimmable image">
								<div class="ui dimmer">
									<div class="content">
									<div class="center">
										<div class="ui blue icon large mfs multiple-custom upload button"><i class="cloud upload icon"></i></div>
									</div>
									</div>
								</div>
								<img src="{{ asset('img/upload-image.png') }}">
								</div>
                            </div>
                            {!! $record->showCardFileOnce() !!}
						</div>
					</td>
				</tr>
				<tr class="active">
					<td colspan="4"><b>Question</b></td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="field">
                            <textarea name="question" class="transparent">{{ $record->desc }}</textarea>
						</div>
					</td>
				</tr>
				<tr class="active">
					<td colspan="4"><b>Answer</b></td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="field">
							<select name="status" class="ui search selection dropdown type_answer">
								<option value="">Choose type answer</option>
								<option {{ $record->status == 0 ? 'selected':'' }} value="0">Multiple Choice</option>
								<option {{ $record->status == 1 ? 'selected':'' }} value="1">True / False</option>
							</select>
						</div>
					</td>
				</tr>
				@if ($record->status == 0)
					<tr class="multichoose">
						<td class="one wide">
							<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" {{ $record->answer->result == 1 ? 'checked':'' }} name="true" value="1">
								<label>A</label>
							</div>
							</div>
						</td>
						<td>
							<div class="field">
								<textarea name="answer[1]" class="transparent">{{ $record->answer->answer_1 }}</textarea>
							</div>
						</td>
						<td class="one wide">
							<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" {{ $record->answer->result == 2 ? 'checked':'' }} name="true" value="2">
								<label>B</label>
							</div>
							</div>
						</td>
						<td>
							<div class="field">
								<textarea name="answer[2]" class="transparent">{{ $record->answer->answer_2 }}</textarea>
							</div>
						</td>
					</tr>
					<tr class="multichoose">
						<td class="one wide">
							<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" {{ $record->answer->result == 3 ? 'checked':'' }} name="true" value="3">
								<label>C</label>
							</div>
							</div>
						</td>
						<td>
							<div class="field">
								<textarea name="answer[3]" class="transparent">{{ $record->answer->answer_3 }}</textarea>
							</div>
						</td>
						<td class="one wide">
							<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" {{ $record->answer->result == 4 ? 'checked':'' }} name="true" value="4">
								<label>D</label>
							</div>
							</div>
						</td>
						<td>
							<div class="field">
								<textarea name="answer[4]" class="transparent">{{ $record->answer->answer_4 }}</textarea>
							</div>
						</td>
					</tr>
				@else
					<tr class="truefalse">
						<td class="one wide" colspan="2">
							<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" {{ $record->answer->result == 1 ? 'checked':'' }} name="true" value="1">
								<label>A</label>
							</div>
							</div>
						</td>
						<td class="one wide" colspan="2">
							<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" {{ $record->answer->result == 2 ? 'checked':'' }} name="true" value="2">
								<label>B</label>
							</div>
							</div>
						</td>
					</tr>
				@endif
			</tbody>
		</table>
	</form>
</div>
<div class="actions">
	<div class="ui black deny button">
		Cancel
	</div>
	<div class="ui positive right labeled icon save button">
		Save
		<i class="checkmark icon"></i>
	</div>
</div>
