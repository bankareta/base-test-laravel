<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit Data {{ $title or '' }}</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
		{{-- <div class="ui error message">
		</div> --}}
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id }}">
        <div class="field">
        	<label>Username</label>
            <div class="ui left icon input">
                <i class="user icon"></i>
                <input type="text" placeholder="Username" name="username" value="{{ $record->username }}" onChange="setDisplayName(this)">
            </div>
        </div>
				<div class="field">
					<label>Fullname / Displayname</label>
						<div class="ui left icon input">
								<i class="address card icon"></i>
								<input type="text" placeholder="Fullname / Displayname" name="fullname" value="{{ $record->display }}">
						</div>
				</div>
        <div class="field">
        	<label>E-Mail</label>
            <div class="ui left icon input">
                <i class="mail icon"></i>
                <input type="email" placeholder="E-Mail" name="email" value="{{ $record->email }}">
            </div>
        </div>
        <div class="field">
        	<label>Roles</label>
			<select name="roles[]" class="ui fluid search dropdown" multiple>
				{!! App\Models\Authentication\Role::options('name', 'id', ['selected' => $record->roles->pluck('id')->toArray()], 'Pilih Hak Akses') !!}
			</select>
        </div>
        <div class="field">
        	<label>Company</label>
			<select name="sites[]" class="ui fluid search dropdown" multiple>
				{!! App\Models\Master\Site::options('name', 'id', ['selected' => $record->site->pluck('id')->toArray()], 'Choose Company') !!}
			</select>
		</div>
		<div class="field">
        	<label>User Position</label>
                <select name="position" class="ui fluid dropdown">
                    <option {{ $record->position == '1' ? 'selected':'' }} value="1">Employee</option>
                    <option {{ $record->position == '0' ? 'selected':'' }} value="0">Contractor</option>
                </select>
        </div>
        <div class="field">
        	<label>Old Password</label>
            <div class="ui left icon input">
                <i class="lock icon"></i>
                <input type="password" name="password_lama" placeholder="Old Password">
            </div>
        </div>
        <div class="field">
        	<label>New Password</label>
            <div class="ui left icon input">
                <i class="lock icon"></i>
                <input type="password" name="password" placeholder="New Password">
            </div>
        </div>
        <div class="field">
        	<label>Confirm Password</label>
            <div class="ui left icon input">
                <i class="unlock alternate icon"></i>
                <input type="password" name="confirm_password" placeholder="Confirm Password">
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

<script>
function setDisplayName(element)
{
		if($('[name="fullname"]').val() == "")
		{
			$('[name="fullname"]').val($(element).val());
		}
}
</script>
