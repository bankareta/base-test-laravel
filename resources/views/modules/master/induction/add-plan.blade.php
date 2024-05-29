<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create New Material Induction</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}/create-plan" method="POST">
		{!! csrf_field() !!}
		<div class="field">
			<label>Title</label>
			<input type="hidden" placeholder="Title" name="materi_id" value="{{ $record->id }}">
			<input type="text" placeholder="Title" name="title" value="{{ old('title') }}">
		</div>
		<div class="field mindate">
			<label>Start Date</label>
			<input type="text" placeholder="Title" name="date_induction_start" value="{{ old('date_induction_start') }}">
		</div>
		<div class="field maxdate">
			<label>End Date</label>
			<input type="text" placeholder="Title" name="date_induction_end" value="{{ old('date_induction_end') }}">
		</div>
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