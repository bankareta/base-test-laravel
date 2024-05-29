<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">{!! $title or '-' !!}</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}/print-summary" method="POST" target="_blank">
		{!! csrf_field() !!}
	  	<div class="field">
	  		<label>Company</label>
	  		<select id="site_id" name="site_id" class="ui class dropdown">
				{!! App\Models\Master\Site::options('name','id',['filters' => [
					function ($site) {
						$site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
					},
					]
				], 'Choose One') !!}
			</select>
		</div>
	  	<div class="field year">
			<label>Tahun</label>
	  		<input type="text" id="yearData" name="year" readonly placeholder="Tahun">
		</div>
	</form>
</div>
<div class="actions">
	<div class="ui black deny button">
		Cancel
	</div>
	<div class="ui positive right labeled icon save button">
		Print
		<i class="print icon"></i>
	</div>
</div>
