<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create New {!! $title or '-' !!}</div>
<div class="content">
	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{!! csrf_field() !!}
		<div class="three fields">
			<div class="field">
				<label>List</label>
				<input type="text" name="name" placeholder="List">
			</div>
			<div class="field">
				<label>QTY</label>
				<input type="number" name="qty" placeholder="QTY">
			</div>
			<div class="field">
				<label>Vendor</label>
				<input type="text" name="vendor" placeholder="Vendor">
			</div>
		</div>
		<div class="three fields">
			<div class="field">
				<label>Plan Budget</label>
				<input type="number" name="plan_budget" placeholder="Plan Budget">
			</div>
			<div class="field">
				<label>Real Budget</label>
				<input type="number" name="real_budget" placeholder="Real Budget">
			</div>
			<div class="field">
				<label>DP</label>
				<input type="number" name="dp" placeholder="DP">
			</div>
		</div>
		<div class="field">
			<button class="ui blue button add-child" type="button">Add More</button>
		</div>
		<div id="show-child">
			
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
