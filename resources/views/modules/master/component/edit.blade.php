<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit Component</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
		
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">
	 	
	  	<div class="field">
	  		<label>Equipment Type</label>
	  		<select id="type_id" name="type_id" class="ui fluid search dropdown">
                {!! App\Models\Master\TypeEquipment::options('name','id',['selected' => $record->type_id], 'Choose One') !!}
            </select>
	  	</div>
	  	<div class="field">
	  		<label>Name Equipment</label>
	  		<input type="text" name="name" placeholder="Name Equipment" readonly="" value="{{ $record->type->name or '' }}">
	  	</div>
	  	<div class="field">
	  		<label>Component</label>
	  		<input type="text" name="component" placeholder="Component" value="{{ $record->component or '' }}">
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