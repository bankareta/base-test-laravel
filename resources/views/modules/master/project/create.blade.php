<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create New Project</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{!! csrf_field() !!}
	  	<div class="field">
	  		<label>Project Type</label>
	  		<select id="type_project" name="type_project" class="ui fluid search dropdown">
                {!! App\Models\Master\TypeProject::options('name','id',[], 'Choose One') !!}
            </select>
	  	</div>
	  	<div class="coderegex field">
	  		<label>Project Number</label>
	  		<input type="text" name="project_number" placeholder="Project Number">
	  	</div>
	  	<div class="field">
	  		<label>Project Name</label>
	  		<input type="text" name="project" placeholder="Project Name">
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
