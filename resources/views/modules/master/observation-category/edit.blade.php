<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit {!! $title or '-' !!}</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">

		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">
	  		<div class="fields">
			<div class="twelve wide field">
				<label>Category</label>
				<input type="text" name="name" placeholder="Category" value="{{ $record->name or '' }}">
		  </div>
			<div class="four wide field">
				<label>Position</label>
				<input type="text" value="{{ $record->position or '0' }}" name="position" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')" placeholder="Position">
		  </div>
		</div>
		<div class="ui one column grid">
			<div class="column">
				<div class="ui fluid card">
					<div class="content" id="showOther">
						<div class="fields">
							<label>Component</label>
							<div class="right floated column">
								<button href="#" class="add-content ui button green" type="button">
									<i class="plus icon"></i>
									Add Component
								</button>
							</div>
						</div>
						@foreach ($record->component as $key => $item)
							@if ($key == 0)
								<div class="fields">
									<div class="four wide field">
										<label>&nbsp;</label>
										<input type="text" name="abbreviation[]" placeholder="Abbreviation" value="{{ $item->abbreviation }}">
									</div>
									<div class="twelve wide field">
										<label>&nbsp;</label>
										<input type="text" name="component[]" placeholder="Component" value="{{ $item->desc }}">
										<input type="hidden" value="{{ $item->id }}" name="component_id[]">
									</div>
								</div>
							@else
								<div class="fields">
									<div class="four wide field">
										<input type="text" name="abbreviation[]" placeholder="Abbreviation" value="{{ $item->abbreviation }}">
									</div>
									<div class="twelve wide field">
										<div class="ui action input">
											<input type="text" name="component[]" placeholder="Component" value="{{ $item->desc }}">
											<input type="hidden" value="{{ $item->id }}" name="component_id[]">
											<button type="button" class="ui red icon button remove-content">
												<i class="trash icon"></i>
											</button>
										</div>
									</div>
								</div>
							@endif
						@endforeach
					</div>
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
