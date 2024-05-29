<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit Regulations & Standards Type</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
		
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">
	 	 <div class="field">
	    	<label>Type</label>
				<select name="type" class="ui fluid dropdown">
					<option value="">Choose One</option>	
					<option value="0" {{ ($record->type == 0) ? 'selected' : '' }}>Regulations</option>	
					<option value="1" {{ ($record->type == 1) ? 'selected' : '' }}>Standards</option>	
				</select>
	  	</div>
	  	<div class="field">
	  		<label>Name</label>
	  		<input type="text" name="name" placeholder="Name" value="{{ $record->name or '' }}">
	  	</div>
	  	<div class="field">
	  		<label>Description</label>
	  		<textarea rows="2" placeholder="Description" name="description">{{ $record->description or '' }}</textarea>
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