<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create HSE Plan</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		
		{!! csrf_field() !!}
	  	<div class="field">
	  		<label>HSE Plan Name</label>
	  		<input type="text" name="name" placeholder="HSE Plan Name">
	  	</div>
	  	<div class="field">
	  		<label>Description</label>
	  		<textarea name="description" placeholder="Description" rows="2"></textarea>
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