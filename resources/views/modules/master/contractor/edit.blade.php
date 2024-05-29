<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit Contractor</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">

		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">

	  	<div class="two fields">
	  		<div class="field">
	  			<label>Contractor's Name</label>
	  			<input type="text" name="company" value="{{ $record->company or '' }}" placeholder="Contractor's Name" maxlength="150">
	  		</div>
	  		<div class="field">
	  			<label>Contract Reference No</label>
	  			<input type="text" name="reference" value="{{ $record->reference or '' }}" placeholder="Contract Reference No" maxlength="150">
			</div>
  		</div>
		<div class="two fields">
	  		<div class="field maxdate">
		  		<label>Contract Commencement Date</label>
		  		<input type="text" name="date" value="{{ $record->date or '' }}" placeholder="Contract Commencement Date">
		  	</div>
		  	<div class="field">
		  		<label>Contract User Name/ Owner</label>
		  		<input type="text" name="owner" value="{{ $record->owner or '' }}" placeholder="Contract User Name/ Owner" maxlength="150">
		  	</div>
	  	</div>
		<div class="two fields">
	  		<div class="field">
		  		<label>Contract Name/Subject (Name of Service)</label>
		  		<input type="text" name="subject" value="{{ $record->subject or '' }}" placeholder="Contract Name/Subject (Name of Service)" maxlength="150">
		  	</div>
		  	<div class="field">
		  		<label>Name of Contact Person Related to Safety & Health Issue</label>
		  		<input type="text" name="contact_person" value="{{ $record->contact_person or '' }}" placeholder="Name of Contact Person Related to Safety & Health Issue" maxlength="150">
			</div>
	  	</div>
		<div class="two fields">
			<div class="field">
		  		<label>Phone Number</label>
		  		<input type="text" name="hp" maxlength="13" value="{{ $record->hp or '' }}" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')" placeholder="Telephone Number">
		  	</div>
		  	<div class="field">
		  		<label>Email Address</label>
		  		<input type="email" name="email" value="{{ $record->email or '' }}" placeholder="Email Address">
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
