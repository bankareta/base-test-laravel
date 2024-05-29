<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit {!! $title or '-' !!}</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
		
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">
		<div class="field">
			<label>Category</label>
			<select id="category" name="category" class="ui fluid search dropdown">
				<option value="">Choose One</option>
				<option {!! $record->category == 'Personal Protective Equipment' ? 'selected':'' !!} value="Personal Protective Equipment">Personal Protective Equipment</option>
				<option {!! $record->category == 'Position of People' ? 'selected':'' !!} value="Position of People">Position of People</option>
				@if ($record->category == 'Procedures or Training')
					<option selected value="Procedures or Training">Procedures or Training</option>
				@else
					<option value="Procedures or Training">Procedures or Training</option>
				@endif
				<option {{ $record->category == 'Tools & Equipment' ? 'selected':'' }} value="Tools & Equipment">Tools & Equipment</option>
				<option {{ $record->category == 'Environmental Compliances' ? 'selected':'' }} value="Environmental Compliances">Environmental Compliances</option>
				<option {{ $record->category == 'Others' ? 'selected':'' }} value="Others">Others</option>
			</select>
		</div>
	  	<div class="field">
	  		<label>Name</label>
	  		<input type="text" name="name" placeholder="Name" value="{{ $record->name or '' }}">
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