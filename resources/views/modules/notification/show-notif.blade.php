@php
	$i = 0;
@endphp

@if(count($record) > 0)
	@foreach($record as $k => $value)
		@php
			$i++;
		@endphp
		<div class="ui dropdown teal item fluid accordion ">
	        <div class="ui title sidebarmenumfs drop-notif ">
	            <i class="laptop icon"></i>
	            {{ $k }}
	            <div class="ui teal left pointing label">{{ $i }}</div>
	        </div>
	        <div class="ui content">
	            <a href="http://supreme-hse.test:88/regulations" class="item sidebarchildmenumfs transition hidden">
	                <i class=" icon"></i>Regulations &amp; Standards
	            </a>
	        </div>
	    </div>  
	@endforeach
@else

@endif