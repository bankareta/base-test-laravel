<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit {!! $title or '-' !!}</div>
<div class="content">
	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">
		<div class="five fields">
			<div class="field">
				<label>Type</label>
				<select name="type" class="ui fluid search dropdown">
					<option value="">Choose One</option>
					<option {{ $record->type == 'Alat shalat' ? 'selected':'' }} value="Alat shalat">Alat shalat</option>
					<option {{ $record->type == 'Makeup' ? 'selected':'' }} value="Makeup">Makeup</option>
					<option {{ $record->type == 'Skincare' ? 'selected':'' }} value="Skincare">Skincare</option>
					<option {{ $record->type == 'Bodycare' ? 'selected':'' }} value="Bodycare">Bodycare</option>
					<option {{ $record->type == 'Daily use' ? 'selected':'' }} value="Daily use">Daily use</option>
					<option {{ $record->type == 'Fashion' ? 'selected':'' }} value="Fashion">Fashion</option>
				</select>
			</div>
			<div class="field">
				<label>List</label>
				<input type="text" name="name" value="{{ $record->name }}" placeholder="List">
			</div>
			<div class="field">
				<label>Merk</label>
				<input type="text" name="merk" value="{{ $record->merk }}" placeholder="Merk">
			</div>
			<div class="field">
				<label>Link</label>
				<input type="text" name="link" value="{{ $record->link }}" placeholder="Link">
			</div>
			<div class="field">
				<label>Real Budget</label>
				<input type="number" name="real_budget" value="{{ $record->real_budget }}" placeholder="Real Budget">
			</div>
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
