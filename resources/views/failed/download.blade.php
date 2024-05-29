@extends('layouts.list')

@section('content')
<div class="ui icon basic message">
	<i class="exclamation triangle icon"></i>
	<div class="content">
		<div class="header">
			404 Berkas Tidak Ditemukan
		</div>
		<p>Berkas yang Anda cari tidak ditemukan.</p>

	</div>
</div>

<div class="ui center aligned very basic segment">
	<a href="javascript:history.back()" class="">
		<i class="chevron left icon"></i>
		Kembali ke halaman sebelumnya
	</a>
</div>
@endsection
