@extends('mails.header',[
	'title' => " ".$title,
	'link' => $urls,
	'subtitle' => isset($subtitle) ? $subtitle : ''
	])
	@section('body')
	<style>

</style>
<div class="row mt-5 pt-5">
	
		<div class="rdg-expertise-category"><span>Induction Material</span></div><br>
	
			<p style="font-size: 11px" class="font-color">
				You Have a New <b>Induction Material</b> for follow this induction please check the link below. 
			</p>
			<div style="clear: both;"></div>
	
</div>

@endsection