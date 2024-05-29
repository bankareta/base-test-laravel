<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create New Man Power Record</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		
		{!! csrf_field() !!}
  		<div class="field">
  			<label>Title</label>
  			<input type="text" name="name" placeholder="Title">
  		</div>
  		<div class="field">
  			<label>Calculation</label>
  			<select class="ui fluid search dropdown" name="hitung">
				<option value="">Choose Type of Calculation</option>
				<option value="avg">AVERAGE</option>
				<option value="sum">SUM</option>
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