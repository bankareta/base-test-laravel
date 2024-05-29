<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="content">
    @if ($type == 'yt')
        <pre id="myCode" data-url="{{ $link }}"></pre>
    @else
        <button onclick="openFullscreen();">Click here to fullscreen</button>
        <iframe src="{{ url('storage/'.$link) }}" id="showframe" style="width: 100%;height: 600px;">
        </iframe>
    @endif
</div> 
<div class="actions">
	<div class="ui black deny button">
		Close
	</div>
</div>
