<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">
	Edit Induction Type
</div>
<div class="content">
	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id }}">
		<div class="ui form">
			<div class="field">
				<label>Name</label>
				<input type="text" name="name" placeholder="Name" value="{{ $record->name or old('name') }}">
			</div>
			
		</div>
	</form>
</div>
<div class="actions">
	<div class="ui black deny button">
		Back
	</div>
	<div class="ui positive right labeled icon save button">
		Save
		<i class="save icon"></i>
	</div>
</div>
