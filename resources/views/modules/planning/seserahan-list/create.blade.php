<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create New {!! $title or '-' !!}</div>
<div class="content">
	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{!! csrf_field() !!}
		<div class="field">
			<button class="ui blue button add-child" type="button">Add More</button>
		</div>
		<div id="show-child">
			<div class="five fields">
				<div class="field">
					<label>Type</label>
					<select name="type[]" class="ui fluid search dropdown">
						<option value="">Choose One</option>
						<option value="Alat shalat">Alat shalat</option>
						<option value="Makeup">Makeup</option>
						<option value="Skincare">Skincare</option>
						<option value="Bodycare">Bodycare</option>
						<option value="Daily use">Daily use</option>
						<option value="Fashion">Fashion</option>
					</select>
				</div>
				<div class="field">
					<label>List</label>
					<input type="text" name="name[]" placeholder="List">
				</div>
				<div class="field">
					<label>Merk</label>
					<input type="text" name="merk[]" placeholder="Merk">
				</div>
				<div class="field">
					<label>Link</label>
					<input type="text" name="link[]" placeholder="Link">
				</div>
				<div class="field">
					<label>Real Budget</label>
					<input type="number" name="real_budget[]" placeholder="Real Budget">
				</div>
			</div>
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
