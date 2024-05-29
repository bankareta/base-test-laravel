<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit Department</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">

		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">
		<div class="field">
			<label>Company</label>
			<select id="site_id" name="site_id" class="ui class companyChoise dropdown">
			  {!! App\Models\Master\Site::options('name','id',[
					'selected' => $record->site_id 
				], 'Choose One') !!}
			</select>
		</div>
	  	<div class="field">
	  		<label>Department</label>
	  		<input type="text" name="name" placeholder="Department" value="{{ $record->name or '' }}">
	  	</div>
	  	<div class="field">
	  		<label>Person In Charge</label>
	  		<select id="pic_id" name="pic" class="ui fluid search dropdown">
            {!! App\Models\Authentication\User::options(function ($user) {
				return $user->display;
			},'id',[
				'selected' => $record->pic,
				'filters' => [
						'status' => 1,
						function ($user) {
								$user->hasAccess();
						}

					],
			], 'Choose One') !!}
          </select>
	  	</div>
	  	<div class="field">
	  		<label>Description</label>
	  		<textarea rows="2" placeholder="Description" name="description">{{ $record->description or '' }}</textarea>
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
