<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create Data {{ $title or '' }}</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{{-- <div class="ui error message">
		</div> --}}
		{!! csrf_field() !!}
        <div class="field">
        	<label>Username</label>
            <div class="ui left icon input">
                <i class="user icon"></i>
                <input type="text" placeholder="Username" name="username" value="{{ old('username') }}" onChange="setDisplayName(this)">
            </div>
        </div>
				<div class="field">
					<label>Fullname / Displayname</label>
						<div class="ui left icon input">
								<i class="address card icon"></i>
								<input type="text" placeholder="Fullname / Displayname" name="fullname" value="{{ old('fullname') }}">
						</div>
				</div>
        <div class="field">
        	<label>E-Mail</label>
            <div class="ui left icon input">
                <i class="mail icon"></i>
                <input type="email" placeholder="E-Mail" name="email" value="{{ old('email') }}">
            </div>
        </div>
        <div class="field">
        	<label>Roles</label>
			<select name="roles[]" class="ui fluid dropdown" multiple>
				{!! App\Models\Authentication\Role::options('name', 'id', [], 'Choose Roles') !!}
			</select>
        </div>
        <div class="field">
        	<label>Password</label>
            <div class="ui left icon input">
                <i class="lock icon"></i>
                <input type="password" name="password" placeholder="Password">
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
