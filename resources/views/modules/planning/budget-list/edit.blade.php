<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit {!! $title or '-' !!}</div>
<div class="content">
	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">
		<div class="three fields">
			<div class="field">
				<label>List</label>
				<input type="text" value="{{ $record->name }}" name="name" placeholder="List">
			</div>
			<div class="field">
				<label>QTY</label>
				<input type="number" value="{{ $record->qty }}" name="qty" placeholder="QTY">
			</div>
			<div class="field">
				<label>Vendor</label>
				<input type="text" value="{{ $record->vendor }}" name="vendor" placeholder="Vendor">
			</div>
		</div>
		<div class="three fields">
			<div class="field">
				<label>Plan Budget</label>
				<input type="number" value="{{ $record->plan_budget }}" name="plan_budget" placeholder="Plan Budget">
			</div>
			<div class="field">
				<label>Real Budget</label>
				<input type="number" value="{{ $record->real_budget }}" name="real_budget" placeholder="Real Budget">
			</div>
			<div class="field">
				<label>DP</label>
				<input type="number" value="{{ $record->dp }}" name="dp" placeholder="DP">
			</div>
		</div>
		<div class="field">
			<button class="ui blue button add-child" type="button">Add More</button>
		</div>
		<div id="show-child">
			@forelse ($record->child as $item)
				<div class="two fields child-data">
					<div class="field">
						<label>List</label>
						<input type="text" value="{{ $item->name }}" name="child_name[]" placeholder="List">
					</div>
					<div class="field">
						<label>Real Budget</label>
						<input type="number" value="{{ $item->real_budget }}" name="child_budget[]" placeholder="Real Budget">
					</div>
				</div>
			@empty
				
			@endforelse
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
