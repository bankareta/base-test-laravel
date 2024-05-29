@extends('layouts.base')

@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/tiny-slider/tiny-slider.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/nanoscroll/nanoscroller.css') }}">
	<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/projects.css') }}">
@append

@section('js')
	<script src="{{ asset('plugins/tiny-slider/tiny-slider.js') }}"></script>
	<script src="{{ asset('plugins/nanoscroll/jquery.nanoscroller.js') }}"></script>
	<script src="{{ asset('plugins/chartjs/Chart.js') }}"></script>
@append

@section('styles')
	<style type="text/css">
	.monitoring.list > .item{
		padding: 1rem !important;
	}
	.ui.card > .extra, .ui.cards > .card > .extra {
		min-height: auto !important;
	}
	.list-container {
		min-height: 300px;
	}
	.ui.feed > .event > .content .extra.text .date {
		display: inline-block;
		float: none;
		font-weight: 400;
		font-size: .85714286em;
		font-style: normal;
		margin: 0 0 0 .5em;
		padding: 0;
		color: rgba(0,0,0,.4);
	}
	.ui.feed .ui.list > .item > i.icon{
		display: inline-block
	}
	.red.item{
		-moz-box-shadow:    inset 0 0 5px #db2828;
		-webkit-box-shadow: inset 0 0 5px #db2828;
		box-shadow:         inset 0 0 5px #db2828;
	}
	</style>
@append

@section('scripts')
	
@append


@section('content')
	{{-- @include('modules.dashboard.widgets.slider') --}}
	<div class="ui stackable equal width grid">
		<div class="sixteen wide column">
			<div class="ui four stackable cards">
				<div class="ui orange card">
					<div class="content">
						<i class="right floated chart line large orange icon"></i>
						<div class="header">Monitoring</div>
					</div>
					<div class="extra content center aligned padded">
						<div class="ui two mini statistics">
							<div class="ui blue statistic">
								<div class="value">
									<a href="{{ url('/monitoring/visitor') }}">{{ $visitor }}</a>
								</div>
								<div class="label">
									<i class="mini">Visitor</i>
								</div>
							</div>
							<div class="ui yellow statistic">
								<div class="value">
									<a href="{{ url('/monitoring/whises') }}">{{ $wishes }}</a>
								</div>
								<div class="label">
									<i class="mini">Wishes</i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="ui blue card">
					<div class="content">
						<i class="right floated envelope outline large blue icon"></i>
						<div class="header">RSVP</div>
					</div>
					<div class="extra content center aligned padded">
						<div class="ui three mini statistics">
							<div class="ui blue statistic">
								<div class="value">
									<a href="{{ url('/monitoring/resv') }}">{{ $resv_hadir }}</a>
								</div>
								<div class="label">
									<i class="mini">Hadir</i>
								</div>
							</div>
							<div class="ui yellow statistic">
								<div class="value">
									<a href="{{ url('/monitoring/resv') }}">{{ $resv_ragu }}</a>
								</div>
								<div class="label">
									<i class="mini">Ragu</i>
								</div>
							</div>
							<div class="ui red statistic">
								<div class="value">
									<a href="{{ url('/monitoring/resv') }}">{{ $resv_tidak }}</a>
								</div>
								<div class="label">
									<i class="mini">Tidak Hadir</i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="ui yellow card">
					<div class="content">
						<i class="right floated address book outline large yellow icon"></i>
						<div class="header">Tamu Undangan</div>
					</div>
					<div class="extra content center aligned padded">
						<div class="ui two mini statistics">
							<div class="ui blue statistic">
								<div class="value">
									<a href="{{ url('/invitation/digital') }}">{{ $digital }}</a>
								</div>
								<div class="label">
									<i class="mini">Male</i>
								</div>
							</div>
							<div class="ui yellow statistic">
								<div class="value">
									<a href="{{ url('/invitation/digital') }}">{{ $fisik }}</a>
								</div>
								<div class="label">
									<i class="mini">Female</i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="ui red card">
					<div class="content">
						<i class="right floated archive large red icon"></i>
						<div class="header">Other</div>
					</div>
					<div class="extra content center aligned padded">
						<div class="ui three mini statistics">
							<div class="ui blue statistic">
								<div class="value">
									<a href="{{ url('/monitoring/gift') }}">{{ $gift }}</a>
								</div>
								<div class="label">
									<i class="mini">Gift</i>
								</div>
							</div>
							<div class="ui yellow statistic">
								<div class="value">
									<a href="{{ url('/planning/seserahan-list') }}">{{ $seserahan }}</a>
								</div>
								<div class="label">
									<i class="mini">Seserahan</i>
								</div>
							</div>
							<div class="ui red statistic">
								<div class="value">
									<a href="{{ url('/undangan/prewedding') }}">{{ $prewed }}</a>
								</div>
								<div class="label">
									<i class="mini">Prewedding</i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="eight wide column">
			<div class="ui segment" style="max-height: 368px;overflow-y: scroll;">
				<h3>List Seserahan</h3>
				<table class="ui celled unstackable table">
					<thead>
						<tr>
							<th width="30%">List</th>
							<th width="35%">Budget</th>
							<th width="35%">Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($seserahan_list as $item)
							<tr>
								<td>{{ $item->name }}</td>
								<td>Rp. {{ number_format($item->real_budget, 0, '', '.') }}</td>
								<td>{!! $item->statusLabel() !!}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="eight wide column">
			<div class="ui segment">
				<h3>Detail Acara</h3>
				<div class="ui celled list">
					<div class="item">
						<div class="content">
						<div class="header">Nama Pengantin</div>
						{{ $acara->cpp }} & {{ $acara->cpw }}
						</div>
					</div>
					<div class="item">
						<div class="content">
						<div class="header">Tanggal Menikah</div>
						{{ $acara->wedding_date ? Helpers::DateToStringWtime($acara->wedding_date):'' }}
						</div>
					</div>
					<div class="item">
						<div class="content">
						<div class="header">Lokasi</div>
						{{ $acara->alamat }} {{ $acara->kelurahan }} {{ $acara->kecamatan }} {{ $acara->kota }} {{ $acara->provinsi }}
						</div>
					</div>
					<div class="item">
						<div class="content">
						<div class="header">Maps</div>
						<a href="{{ $acara->lokasi_maps }}" target="_blank" rel="noopener noreferrer">{{ $acara->lokasi_maps }}</a>
						</div>
					</div>
					<div class="item">
						<div class="content">
						<div class="header">Informasi Calon Pengantin Pria</div>
						{{ $acara->status_cpp }} dari Bpk {{ $acara->bpk_cpp }} dan Ibu {{ $acara->ibu_cpp }}
						</div>
					</div>
					<div class="item">
						<div class="content">
						<div class="header">Informasi Calon Pengantin Wanita</div>
						{{ $acara->status_cpw }} dari Bpk {{ $acara->bpk_cpw }} dan Ibu {{ $acara->ibu_cpw }}
						</div>
					</div>
					<div class="item">
						<div class="content">
						<div class="header">Quotes</div>
						{{ $acara->title_quotes }} <br> {{ $acara->quotes }}
						</div>
					</div>
					<div class="item">
						<div class="content">
						<div class="header">No. Rekening</div>
						{{ $acara->no_rek }} ({{ $acara->bank }}) <br>{{ $acara->no_rek_2 }} ({{ $acara->bank_2 }})
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="sixteen wide column">
			<div class="ui segment">
				<a href="{{ url('/planning/budget-list') }}"><h3>List Wedding</h3></a>
				<table class="ui celled unstackable table">
					<thead>
						<tr>
							<th width="30%">List</th>
							<th width="35%">DP</th>
							<th width="35%">Debt</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($wedding_list as $item)
							<tr>
								<td>{{ $item->name }}</td>
								<td>Rp. {{ number_format($item->dp, 0, '', '.') }}</td>
								<td>Rp. {{ number_format($item->debt, 0, '', '.') }}</td>
							</tr>
						@endforeach
						<tr>
							<td><b>TOTAL</b></td>
							<td><b>Rp. {{ number_format($wedding_list->sum('dp'), 0, '', '.') }}</b></td>
							<td><b>Rp. {{ number_format($wedding_list->sum('debt'), 0, '', '.') }}</b></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
