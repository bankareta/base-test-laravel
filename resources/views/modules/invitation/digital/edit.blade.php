<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit {!! $title or '-' !!}</div>
<div class="content">
	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">
		<div class="three fields">
			<div class="field">
				<label>Nama Tamu Undangan</label>
				<input type="text" name="name" value="{{ $record->name }}" placeholder="Nama Tamu Undangan">
			</div>
			<div class="field">
				<label>No. Whatsapp</label>
				<input type="text" name="no_telp" value="{{ $record->no_telp }}" placeholder="No. Whatsapp">
			</div>
			<div class="field">
				<label>Undangan Dari Pihak</label>
				<select name="from" class="ui fluid search dropdown">
					<option value="">Choose One</option>
					<option {{ $record->from == 'male' ? 'selected':'' }} value="male">Laki-laki</option>
					<option {{ $record->from == 'female' ? 'selected':'' }} value="female">Perempuan</option>
				</select>
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
