<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" href="{{ asset('img/icon.png') }}" sizes="192x192">
	<title>REPORT INDUSTRIAL INSPECTION</title>
	<style>
	/* @page { margin: 0in; } */
	.ui.table.bordered {
		border: 1px solid #055998;
		border-collapse: collapse;
		width: 100%;
	}

	.ui.table.bordered td {
		border: 1px solid #055998;
		border-collapse: collapse;
		padding:10px;
	}

	.ui.table.bordered td img {
		padding: 10px;
	}

	.ui.table.bordered td.center.aligned {
		text-align : center;
	}

	body { 
		/* TRBL */
		margin: 10px 10px 5px 10px; 
		border: 1px solid #055998; }
		.container{
			margin: 20px 20px 20px 20px;
			text-align: justify;
			text-justify: inter-word;
		}
		.content{
			margin: 2px 3px 2px 3px;
			text-align: justify;
			text-justify: inter-word;
		}
		p{
			/* font-size: 20px */
			text-align: justify;
			text-justify: inter-word;
		}
		input[type=checkbox] { display: inline; }
		.tbl-first{
			width: 100%;
			font-size: 17px;
			text-align: justify;
			text-justify: inter-word;
		}
		.tbl-content{
			width: 100%;
			font-size: 17px;
			text-align: justify;
			text-align: center;
			text-justify: inter-word;
		}
		.header-content{
			text-align: center;
		}
		.tbl-content-2{
			vertical-align: top;
			width: 100%;
			font-size: 12px;
			border : 1px solid #055998;
		}
		.tbl-content-2 > tbody > tr > td{
			vertical-align: top;
			border-left : 1px solid #055998;
			border-right : 1px solid #055998;
			border-top : 1px solid #055998;
			border-bottom : 1px solid #055998;
			border-style: dotted;
		}

		h2{
			font-size: 30px;
		}
		.page-break {
			page-break-after: always;
		}

		/* BATAS */
		.rdg-expertise-category { float: left; display:flex;flex-direction:column; position:relative;}
		.rdg-expertise-category span { margin-top:auto; font-size: 12px; font-weight: bold; }

		.rdg-expertise-description {  display:flex;flex-direction:column; padding-bottom: 20px;}
		.rdg-expertise-description p { margin-top:auto;height: 100px}

		.rdg-expertise-bar { margin: auto; height: 0; width: 0; overflow: hidden; }

		@keyframes rdg-expertise-bar-animation-keyframe {
			0%   { height: 0; width: 0; }
			100% {width: 10px;height: 130px;} 
		}
		.row {
			border: #c0c5c7 1px dashed;
			margin: auto;
			margin-top: auto;
		}

		.text-pull-right {
			text-align: right;
		}
		.text-pull-left {
			text-align: left;
		}
		.border.right {
			border-right: 1px solid black;
		}
		.font-color {
			color: rgb(128, 128, 128);
		}

		.pt-5, .py-5 {
			padding-top: 1rem !important;
		}
		.mt-5, .my-5 {
			margin-top: 1rem !important;
		}
		
		.row {
			margin-right: 0px;
			margin-left: 0px;
		}
		*, ::before, ::after {
			box-sizing: border-box;
		}
		.col-6 {
			-webkit-box-flex: 0;
			-ms-flex: 0 0 50%;
			flex: 0 0 50%;
			max-width: 50%;
		}


	</style>
</head>
<body>
	{{-- @include('style.temp') --}}
	<script type="text/php">
		if (isset($pdf)) {
		$font = $fontMetrics->getFont("Times New Romans", "bold");

		$pdf->page_text(510, 820, "Page {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0, 0, 0));
		$pdf->page_text(40, 10, "Downloaded by : {{auth()->user()->username}}", $font, 10, array(0, 0, 0));
		$pdf->page_text(400, 10, "Downloaded Date : {{$today}}", $font, 10, array(0, 0, 0));
	}
</script>
<header>
	<table class="ui table bordered">
		<tr>
			<td class="center aligned" width="30%"><img src="{{ asset('img/icon-long.png') }}" width="200" ></td>
			<td class="center aligned" width="60%"><h5>Industrial Hygiene Inspection</h5></td>
		</tr>
		<tr>
			<td class="center aligned" colspan="2">{{ $title }}</td>
		</tr>
	</table>
</header>
<div class="container">
	<table style="font-size: 12px;border-collapse: collapse;" width="100%">
		<tbody class="text-pull-left">	
			<tr>
				<td style="width: 80px">Project No./Contract No</td>
				<td style="width: 300px">: <span>{{ $record->contractor->reference or '' }}</span></td>
			</tr>	
			<tr>
				<td style="width: 80px">Contractor's Name </td>
				<td style="width: 300px">: <span>{{ $record->contractor->company or '' }}</span></td>
			</tr>
			<tr>
				<td style="width: 80px">Date of Inspection</td>
				<td class="" style="width: 300px">: <span>{{ $record->date_inspection or '' }}</span></td>
			</tr>
			<tr>
				<td style="width: 80px">Company</td>
				<td class="" style="width: 300px">: <span>{{ $record->site->name or '' }}</span></td>
			</tr>
			<tr>
				<td style="width: 80px">Inspected By</td>
				<td class="" style="width: 300px">: <span>{{ $record->inspected->display or '' }}</span></td>
			</tr>
			<tr>
				<td style="width: 80px">Location</td>
				<td class="" style="width: 300px">: <span>{{ $record->location or '' }}</span></td>
			</tr>
			<tr>
				<td style="width: 80px">Building</td>
				<td class="" style="width: 300px">: <span>{{ $record->building or '' }}</span></td>
			</tr>
			<tr>
				<td style="width: 80px">Area</td>
				<td class="" style="width: 300px">: <span>{{ $record->area or '' }}</span></td>
			</tr>
			<tr>
				<td style="width: 80px">Type</td>
				<td class="" style="width: 300px">: <span>{{ $record->typeLabel() }}</span></td>
			</tr>
		</tbody>
	</table>
	<h5 class="">Work Area Information </h5>
	<div class="row mt-5 pt-5">
		<div class="col-12">
			<div class="rdg-expertise-bar rdg-brief-bg rdg-animated-delay-0 text-right" style="float: left;"></div>
			<div class="rdg-expertise-category"><span>What is the Operation :</span></div><br>
			<div class="rdg-expertise-description">
				<p style="font-size: 11px">
					{!! $record->operation or '' !!}
				</p>
				<div style="clear: both;"></div>
			</div>
			<div class="rdg-expertise-category"><span>To What Material or Condition Are Employees Exposed ? :</span></div><br>
			<div class="rdg-expertise-description">
				<p style="font-size: 11px">
					{!! $record->material or '' !!}
				</p>
				<div style="clear: both;"></div>
			</div>
			<div class="rdg-expertise-category"><span>What Procedure Are Being Used ? :</span></div><br>
			<div class="rdg-expertise-description">
				<p style="font-size: 11px">
					{!! $record->procedures or '' !!}
				</p>
				<div style="clear: both;"></div>
			</div>
			<div class="rdg-expertise-category"><span>Number of Employees Exposed and For How Long ? :</span></div><br>
			<div class="rdg-expertise-description">
				<p style="font-size: 11px">
					{!! $record->employees or '' !!}
				</p>
				<div style="clear: both;"></div>
			</div><br><br><br><br>
			<div class="rdg-expertise-category"><span>Monitoring Performed  :</span></div><br>
			<div class="rdg-expertise-description">
				<p style="font-size: 11px">
					{!! $record->monitoring or '' !!}
				</p>
				<div style="clear: both;"></div>
			</div>
			<div class="rdg-expertise-category"><span>Results and Remarks  :</span></div><br>
			<div class="rdg-expertise-description">
				<p style="font-size: 11px">
					{!! $record->remarks or '' !!}
				</p>
				<div style="clear: both;"></div>
			</div>
		</div>
	</div>
	
</div>

</body>
</html>
