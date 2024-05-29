<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create New {!! $title or '-' !!}</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{!! csrf_field() !!}
		<div class="ui segment">
			<div class="field">
				<div class="ui centered cards" id="inputImg">
					<div class="small card">
					<input type="file" class="hidden mfs multiple file-custom input" name="picture[]" accept="image/*" data-url="{{ url($pageUrl.'import-img/') }}">
					<div class="blurring dimmable image">
						<div class="ui dimmer">
						<div class="content">
							<div class="center">
							<div class="ui blue icon large mfs multiple-custom upload button"><i class="cloud upload icon"></i></div>
							</div>
						</div>
						</div>
						<img src="{{ asset('img/upload-image.png') }}">
					</div>
					</div>
				</div>
				<div class="ui visible message">
					<h3>Recommendation Size Image: <b>1500 x 458</b></h3>
				</div>
				<div class="ui centered cards" id="showImg">
					<div class="ui center aligned segment" id="img1" style="padding:0; overflow:hidden; height:356px;width: 1043px;">
						<div class="ui top attached label">Preview</div>
						<div class="image-container">
							<img class="image-preview center aligned" id="showAttachment" style="width: 100%;height: auto;margin-top: -37px;" src="{{ asset('img/no-images-landscape.png') }}">
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="field">
				<input type="number" id="position" name="position" min="0" readonly placeholder="Search Focus">
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
