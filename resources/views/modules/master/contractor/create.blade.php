<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create New Contractor</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{!! csrf_field() !!}
		<div class="two fields">
			<div class="field">
				<label>Contractor's Name</label>
				<input type="text" name="company" placeholder="Contractor's Name" maxlength="150">
			</div>
			<div class="field">
				<label>Contract Reference No</label>
				<input type="text" name="reference" placeholder="Contract Reference No" maxlength="150">
			</div>
		</div>
		<div class="two fields">
	  		<div class="field maxdate">
		  		<label>Contract Commencement Date</label>
		  		<input type="text" name="date" placeholder="Contract Commencement Date">
		  	</div>
		  	<div class="field">
		  		<label>Contract User Name/ Owner</label>
		  		<input type="text" name="owner" placeholder="Contract User Name/ Owner" maxlength="150">
			</div>
	  	</div>
		<div class="two fields">
	  		<div class="field">
		  		<label>Contract Name/Subject (Name of Service)</label>
		  		<input type="text" name="subject" placeholder="Contract Name/Subject (Name of Service)" maxlength="150">
		  	</div>
		  	<div class="field">
		  		<label>Name of Contact Person Related to Safety & Health Issue</label>
		  		<input type="text" name="contact_person" placeholder="Name of Contact Person Related to Safety & Health Issue" maxlength="150">
			</div>
	  	</div>
		<div class="two fields">
			<div class="field">
		  		<label>Phone Number</label>
		  		<input type="text" name="hp" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')" placeholder="Telephone Number">
		  	</div>
		  	<div class="field">
		  		<label>Email Address</label>
		  		<input type="email" name="email" placeholder="Email Address">
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
