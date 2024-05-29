<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Edit New Material Induction</div>
<div class="content">
	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or '' }}">
		<div class="field">
			<label>Material Name</label>
			<input type="text" placeholder="Material Name" name="name" value="{{ $record->name or '' }}">
		</div>
		<div class="field">
			<label>Induction Type</label>
			<select class="ui fluid search dropdown" name="type_id">
				{!! \App\Models\Master\TypeInduction::options('name','id',['selected' => $record->type_id],'Choose Type') !!}
			</select>
		</div>
		<div class="field areafile">
			<label>Attachment Induction Material</label>
			<div class="ui dimmable centered special five cards">
				@switch(Helpers::showFileExtension($record->fileurl))
					@case('pdf')
							<div class="ui dimmable small card">
								<div class="blurring dimmable image">
									<div class="ui dimmer">
										<div class="content">
											<div class="center">
												<a href="#" class="ui inverted massive blue icon button delete-file" data-url="{{ base64_encode($record->fileurl) }}"><i class="trash icon"></i></a>
											</div>
										</div>
									</div>
									<img src="{{ Helpers::showImgExtension($record->fileurl,true) }}">
								</div>
								<div class="extra content">
									<a>
										<i class="users icon"></i>
										{{ substr($record->filename,0,14) }}...
									</a>
								</div>
							</div>
						@break
					@case('film')
						<div class="ui dimmable small card">
							<div class="blurring dimmable image">
								<div class="ui dimmer">
									<div class="content">
										<div class="center">
											<a href="#" class="ui inverted massive blue icon button delete-file" data-type="video" data-url="{{ base64_encode($record->fileurl) }}"><i class="trash icon"></i></a>
										</div>
									</div>
								</div>
								<img src="{{ Helpers::showImgExtension($record->fileurl,true) }}">
							</div>
							<div class="extra content">
								<a>
								<i class="users icon"></i>
									Video Attachment
								</a>
							</div>
						</div>
						@break
					@default
					<div class="ui dimmable small card">
						<div class="blurring dimmable image">
							<div class="ui dimmer">
								<div class="content">
									<div class="center">
										<a href="#" class="ui inverted massive blue icon button delete-file" data-type="video" data-url="{{ base64_encode($record->fileurl) }}"><i class="trash icon"></i></a>
									</div>
								</div>
							</div>
							<img src="{{ Helpers::showImgExtension($record->fileurl,true) }}">
						</div>
						<div class="extra content">
							<a>
								<i class="users icon"></i>
								{{ substr($record->filename,0,14) }}...
							</a>
						</div>
					</div>
				@endswitch
				@if ($record->child->count() > 0)
					@foreach ($record->child as $child)
						@switch(Helpers::showFileExtension($child->fileurl))
							@case('pdf')
								<div class="ui dimmable small card">
									<div class="blurring dimmable image">
										<div class="ui dimmer">
											<div class="content">
												<div class="center">
													<a href="#" class="ui inverted massive blue icon button delete-file" data-url="{{ base64_encode($child->fileurl) }}"><i class="trash icon"></i></a>
												</div>
											</div>
										</div>
										<img src="{{ Helpers::showImgExtension($child->fileurl,true) }}">
									</div>
									<div class="extra content">
										<a>
											<i class="users icon"></i>
											{{ substr($child->filename,0,14) }}...
										</a>
									</div>
								</div>
								@break
							@case('film')
								<div class="ui dimmable small card">
									<div class="blurring dimmable image">
										<div class="ui dimmer">
											<div class="content">
												<div class="center">
													<a href="#" class="ui inverted massive blue icon button delete-file" data-type="video" data-url="{{ base64_encode($child->fileurl) }}"><i class="trash icon"></i></a>
												</div>
											</div>
										</div>
										<img src="{{ Helpers::showImgExtension($child->fileurl,true) }}">
									</div>
									<div class="extra content">
										<a>
										<i class="users icon"></i>
											Video Attachment
										</a>
									</div>
								</div>
								@break
							@default
							<div class="ui dimmable small card">
								<div class="blurring dimmable image">
									<div class="ui dimmer">
										<div class="content">
											<div class="center">
												<a href="#" class="ui inverted massive blue icon button delete-file" data-type="video" data-url="{{ base64_encode($child->fileurl) }}"><i class="trash icon"></i></a>
											</div>
										</div>
									</div>
									<img src="{{ Helpers::showImgExtension($child->fileurl,true) }}">
								</div>
								<div class="extra content">
									<a>
										<i class="users icon"></i>
										{{ substr($child->filename,0,14) }}...
									</a>
								</div>
							</div>
						@endswitch
					@endforeach
				@endif
			</div>
		</div>
		<div class="showdeletefile">

		</div>
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
			<input type="text" placeholder="Embed Youtube" name="link_yt" value="{{ $record->link_yt or '' }}">
		</div>
		<div class="field">
	    <div class="ui checkbox">
	      <input type="checkbox" name="without_quiz" value="1" tabindex="0" class="hidden" {{ $record->without_quiz == 1 ? 'checked' : '' }}>
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
