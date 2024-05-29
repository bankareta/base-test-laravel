<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create Audit Type</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		
		{!! csrf_field() !!}
	  	<div class="field">
	  		<label>Audit Type</label>
	  		<input type="text" name="name" placeholder="Audit Type">
	  	</div>
	  	<div class="field">
	  		<label>Description</label>
	  		<textarea rows="2" name="description" placeholder="Description"></textarea>
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