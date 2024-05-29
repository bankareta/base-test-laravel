<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Detail Question Material Induction</div>
<div class="content">
    <form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">

		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">
		<input type="hidden" name="materi_id" value="{{ $id }}">
		<table class="ui celled structured table">
			<tbody>
				<tr class="active">
					<td class="two wide" colspan="4"><b>Question Image</b></td>
				</tr>
				<tr>
					<td colspan="4" id="showFileExistDelete">
						<div class="ui centered cards">
                            {!! $record->showCardFileOnce('detil') !!}
						</div>
					</td>
				</tr>
				<tr class="active">
					<td colspan="4"><b>Question</b></td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="field">
                            <textarea readonly name="question" class="transparent">{{ $record->desc }}</textarea>
						</div>
					</td>
				</tr>
				<tr class="active">
					<td colspan="4"><b>Answer</b></td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="field">
							<select name="status" class="ui search selection dropdown" disabled>
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
								<input type="radio" disabled {{ $record->answer->result == 1 ? 'checked':'' }} name="true" value="1">
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
								<input type="radio" disabled {{ $record->answer->result == 2 ? 'checked':'' }} name="true" value="2">
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
								<input type="radio" disabled {{ $record->answer->result == 3 ? 'checked':'' }} name="true" value="3">
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
								<input type="radio" disabled {{ $record->answer->result == 4 ? 'checked':'' }} name="true" value="4">
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
								<input type="radio" disabled {{ $record->answer->result == 1 ? 'checked':'' }} name="true" value="1">
								<label>A</label>
							</div>
							</div>
						</td>
						<td class="one wide" colspan="2">
							<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" disabled {{ $record->answer->result == 2 ? 'checked':'' }} name="true" value="2">
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
		Close
	</div>
</div>
