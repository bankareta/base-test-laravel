<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit Observation Card Type</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
	
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">
	 	
	  	<div class="field">
	  		<label>Observation Card Type</label>
	  		<input type="text" name="name" placeholder="Observation Card Type" value="{{ $record->name or '' }}">
	  	</div>
	  	<div class="field">
	  		<label>Description</label>
	  		<textarea rows="2" name="description" placeholder="Description">{{ $record->description or '' }}</textarea>
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