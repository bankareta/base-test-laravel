<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create Component</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{!! csrf_field() !!}
		<div class="field">
	  		<label>Equipment Type</label>
	  		<select id="type_id" name="type_id" class="ui fluid search dropdown child only-name" data-child="getTypeEquipment">
                {!! App\Models\Master\TypeEquipment::options('name','id',[], 'Choose One') !!}
            </select>
	  	</div>
	  	<div class="field">
	  		<label>Name Equipment</label>
	  		<input id="getTypeEquipment" type="text" name="name" placeholder="Name Equipment" readonly="">
	  	</div>
	  	<div class="field">
	  		<label>Component</label>
	  		<input type="text" name="component" placeholder="Component">
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