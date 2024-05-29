<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create New Regulations & Standards Type</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		
		{!! csrf_field() !!}
	 	 <div class="field">
	    	<label>Type</label>
				<select name="type" class="ui fluid dropdown">
					<option value="">Choose One</option>	
					<option value="0">Regulations</option>	
					<option value="1">Standards</option>	
				</select>
	  	</div>
	  	<div class="field">
	  		<label>Name</label>
	  		<input type="text" name="name" placeholder="Name">
	  	</div>
	  	<div class="field">
			<label>Description</label>
			<textarea name="description" placeholder="Description"></textarea>
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