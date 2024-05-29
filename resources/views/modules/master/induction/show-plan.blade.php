<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Detail Induction Plan</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}/create-plan" method="POST">
		{!! csrf_field() !!}
		<div class="field">
			<label>Title</label>
			<input type="hidden" placeholder="Title" name="materi_id" value="{{ $record->materi_id }}">
			<input type="text" readonly placeholder="Title" name="title" value="{{ $record->title }}">
		</div>
		<div class="field">
			<label>Start Date</label>
			<input type="text" readonly placeholder="Title" name="date_induction_start" value="{{ Helpers::DateToString($record->date_induction_start) }}">
		</div>
		<div class="field">
			<label>End Date</label>
			<input type="text" readonly placeholder="Title" name="date_induction_end" value="{{ Helpers::DateToString($record->date_induction_end) }}">
		</div>
	</form>
</div>
<div class="actions">
	<div class="ui black deny button">
		Close
	</div>
</div>
