<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">{!! $title or '-' !!}</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}/aprove-modal" method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="id" value="{{ $record->id }}">
		<div class="field date">
			<label>Appointment Date</label>
	  		<input type="text" name="appointment_date" id="duedate" readonly placeholder="Appointment Date">
		</div>
		<div class="field">
			<label>Location Appointment</label>
			<input type="text" name="appointment_location" id="location" placeholder="Location Appointment">
		</div>
	</form>
</div>
<div class="actions">
	<div class="ui black deny button">
		Cancel
	</div>
	<div class="ui positive right labeled icon save button">
		Submit
		<i class="checkmark icon"></i>
	</div>
</div>
