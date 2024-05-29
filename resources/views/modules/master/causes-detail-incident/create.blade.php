<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create {!! $title or '-' !!}</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{!! csrf_field() !!}
			<div class="field">
	  		<label>Causes</label>
	  		<select id="causes_incident_id" name="causes_incident_id" class="ui fluid search dropdown child only-name" data-child="getTypeEquipment">
                {!! App\Models\Master\CausesIncident::options('name','id',[], 'Choose One') !!}
            </select>
	  	</div>
	  	<div class="field">
	  		<label>Detail</label>
	  		<textarea name="detail" placeholder="Detail"></textarea>
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
