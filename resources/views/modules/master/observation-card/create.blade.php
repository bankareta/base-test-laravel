<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create New {!! $title or '-' !!}</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
	
		{!! csrf_field() !!}
		<div class="field">
			<label>Category</label>
			<select id="category" name="category" class="ui fluid search dropdown">
				<option value="">Choose One</option>
				<option value="Personal Protective Equipment">Personal Protective Equipment</option>
				<option value="Position of People">Position of People</option>
				<option value="Procedures or Training">Procedures or Training</option>
				<option value="Tools & Equipment">Tools & Equipment</option>
				<option value="Environmental Compliances">Environmental Compliances</option>
				<option value="Others">Others</option>
			</select>
		</div>
	  	<div class="field">
	  		<label>Name</label>
	  		<input type="text" name="name" placeholder="Name">
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
