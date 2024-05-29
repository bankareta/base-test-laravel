<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit Man Power Record</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
	
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">
	 	
	  	<div class="field">
  			<label>Title</label>
  			<input type="text" name="name" placeholder="Title" value="{{ $record->name or '' }}">
  		</div>
  		<div class="field">
  			<label>Calculation</label>
  			<select class="ui fluid search dropdown" name="hitung">
				<option value="">Choose Type of Calculation</option>
				<option value="avg" {{ ($record->hitung == 'avg') ? 'selected' : '' }}>AVERAGE</option>
				<option value="sum" {{ ($record->hitung == 'sum') ? 'selected' : '' }}>SUM</option>
			</select>
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