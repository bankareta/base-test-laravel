<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create New Question Material Induction</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{!! csrf_field() !!}
		<input type="hidden" name="materi_id" value="{{ $id }}">
		<table class="ui celled structured table">
			<tbody class="show-answer">
				<tr class="active">
					<td class="two wide" colspan="4"><b>If you want use the Previous Question</b></td>
				</tr>
				<tr>
					<td colspan="4" class="field">
						<select class="ui fluid search dropdown pre_ans" name="type_id">
							{!! \App\Models\Master\InductionQuestion::options('desc','id',['filters' => [
								function ($q) use($id) {
									// $q->where('materi_id','!=', $id);
								},
							  ]],'Previous Question') !!}
						</select>
					</td>
				</tr>
				<tr class="active">
					<td class="two wide" colspan="4"><b>Add Question Image</b></td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="ui centered cards showimgpre">
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
						</div>
					</td>
				</tr>
				<tr class="active">
					<td colspan="4"><b>Question</b></td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="field">
							<textarea name="question" class="transparent questionpre"></textarea>
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
								<option value="0">Multiple Choice</option>
								<option value="1">True / False</option>
							</select>
						</div>
					</td>
				</tr>
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
