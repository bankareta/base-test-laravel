<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Create New Material Induction</div>
<div class="content">
 	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{!! csrf_field() !!}
		<div class="field">
			<label>Material Name</label>
			<input type="text" placeholder="Material Name" name="name" value="{{ old('name') }}">
		</div>
		<div class="field">
			<label>Induction Type</label>
			<select class="ui fluid search dropdown" name="type_id">
				{!! \App\Models\Master\TypeInduction::options('name','id',[],'Choose Type') !!}
			</select>
		</div>
		{{-- <div class="field">
			<label>Material File Type</label>
			<select class="ui fluid search dropdown" name="type_materi" id="materialFile">
				<option value="">Choose Type</option>
				<option value="1">File</option>
				<option value="0">Youtube</option>
			</select>
		</div> --}}
		<div id="fileArea" class="field">
			<div class="mfs fileupload" data-id="1" style="margin-bottom: -20px;">
				<div class="fields showing1" data-id="1">
					<div class="two wide field">
						<label>File</label>
						<button type="button" class="ui fluid small icon upload mfs file button" data-id="1">....</button>
						<input type="file" class="hidden mfs file upload" name="file" data-id="1" autocomplete="off" accept="video/mp4, application/pdf, application/msword,.doc, .docx,.ppt, .pptx, application/vnd.ms-powerpoint">
					</div>
					<div class="fourteen wide field">
						<label class="show filename1">&nbsp;&nbsp;</label>
						<div class="ui teal standard progress checkID" data-id="1" id="progresBar1">
							<div class="bar">
								<div class="progress"></div>
							</div>
						</div>
					</div>
					<div class="showInput1" data-id="1"></div>
				</div>
			</div>
		</div>
		<div id="ytArea" class="field">
			<label>Embed Youtube : <small style="color: red !important;"><i>https://www.youtube.com/watch?v=FYb1Jlq4XU4</i></small></label>
			<input type="text" placeholder="Embed Youtube" name="link_yt" value="{{ old('link_yt') }}">
		</div>
		<div class="field">
	    <div class="ui checkbox">
	      <input type="checkbox" name="without_quiz" value="1" tabindex="0" class="hidden">
	      <label><b>Check here if this induction without quiz</b></label>
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
