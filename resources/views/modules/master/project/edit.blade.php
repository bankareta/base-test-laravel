<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit Project</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">

		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">

	  	<div class="coderegex field">
	  		<label>Project Type</label>
	  		<select id="type_project" name="type_project" class="ui fluid search dropdown">
                {!! App\Models\Master\TypeProject::options('name','id',['selected' => $record->type_project]) !!}
            </select>
	  	</div>
	  	<div class="field">
	  		<label>Project Number</label>
	  		<input type="text" name="project_number" placeholder="Project Number" value="{{ $record->project_number or '' }}">
	  	</div>
	  	<div class="field">
	  		<label>Project Name</label>
	  		<input type="text" name="project" placeholder="Project Name" value="{{ $record->project or '' }}">
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
