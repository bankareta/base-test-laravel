<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create New {!! $title or '-' !!}</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{!! csrf_field() !!}
	  	<div class="fields">
			<div class="twelve wide field">
				<label>Category</label>
				<input type="text" name="name" placeholder="Category">
		  </div>
			<div class="four wide field">
				<label>Position</label>
				<input type="text" maxlength="5" name="position" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')" placeholder="Position">
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
						<div class="fields">
							<div class="four wide field">
								<label>&nbsp;</label>
								<input type="text" name="abbreviation[]" placeholder="Abbreviation">
							  </div>
							<div class="twelve wide field">
								<label>&nbsp;</label>
								<input type="text" name="component[]" placeholder="Component">
						  	</div>
						</div>
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
