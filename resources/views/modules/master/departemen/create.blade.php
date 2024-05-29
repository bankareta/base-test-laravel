<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create New Department</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">

		{!! csrf_field() !!}
		<div class="field">
			<label>Company</label>
			<select id="site_id" name="site_id" class="ui class companyChoise dropdown">
				{!! App\Models\Master\Site::options('name','id',['filters' => [
					function ($site) {
						$site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
					},
				]
				], 'Choose One') !!}
			</select>
		</div>
	  	<div class="field">
	  		<label>Department</label>
	  		<input type="text" name="name" placeholder="Department">
	  	</div>
	  	<div class="field">
	  		<label>Person In Charge</label>
	  		<select id="pic_id" name="pic" class="ui fluid search dropdown">
            {!! App\Models\Authentication\User::options(function ($user) {
				return $user->display;
			},'id',['filters' => [
					'status' => 1,
					function ($user) {
						$user->hasAccess();
					}
				]
			], 'Choose One') !!}
          </select>
	  	</div>
	  	<div class="field">
	  		<label>Description</label>
	  		<textarea name="description" placeholder="Description" rows="2"></textarea>
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
