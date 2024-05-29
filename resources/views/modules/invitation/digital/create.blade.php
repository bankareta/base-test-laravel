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
			<div class="three fields">
				<div class="field">
					<label>Nama Tamu Undangan</label>
					<input type="text" name="name[]" placeholder="Nama Tamu Undangan">
				</div>
				<div class="field">
					<label>No. Whatsapp</label>
					<input type="text" name="no_telp[]" placeholder="No. Whatsapp">
				</div>
				<div class="field">
					<label>Undangan Dari Pihak</label>
					<select name="from[]" class="ui fluid search dropdown">
						<option value="">Choose One</option>
						<option value="male">Laki-laki</option>
						<option value="female">Perempuan</option>
					</select>
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
