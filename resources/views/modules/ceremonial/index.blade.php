@extends('layouts.form')

@section('styles')
<style type="text/css">
    .ui.inverted.progress{
        margin: 0 0 0 0 !important;
        height: 25px;
    }
    .ui.inverted.progress > .bar{
        height: 25px;
    }
    #labelInfo{
        padding: 7px;
    }
    td {
        overflow: visible !important;
    }
</style>
@endsection

@section('scripts')

@endsection

@section('content-body')
<form id="dataForm" action="{{ url($pageUrl) }}" class="ui form" method="POST">
    <div class="ui form">
        {!! csrf_field() !!}
        <div class="ui segment">
            <h4 class="ui dividing header">Informasi CPP (Calon Pengantin Pria)</h4>
            <div class="four fields">
                <div class="field">
                    <label>Nama CPP</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->cpp:'' }}" name="cpp" placeholder="Nama CPP">
                </div>
                <div class="field">
                    <label>Nama Bapak CPP</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->bpk_cpp:'' }}" name="bpk_cpp" placeholder="Nama Bapak CPP">
                </div>
                <div class="field">
                    <label>Nama Ibu CPP</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->ibu_cpp:'' }}" name="ibu_cpp" placeholder="Nama Ibu CPP">
                </div>
                <div class="field">
                    <label>Status CPP</label>
                    <select class="ui fluid search dropdown" name="status_cpp">
                        <option value="">Choose One</option>
                        <option {{ $record->count() > 0 ? ($record->first()->status_cpp == 'Putra Tunggal' ? 'selected':''):'' }} value="Putra Tunggal">Putra Tunggal</option>
                        <option {{ $record->count() > 0 ? ($record->first()->status_cpp == 'Putra Pertama' ? 'selected':''):'' }} value="Putra Pertama">Putra Pertama</option>
                        <option {{ $record->count() > 0 ? ($record->first()->status_cpp == 'Putra Kedua' ? 'selected':''):'' }} value="Putra Kedua">Putra Kedua</option>
                        <option {{ $record->count() > 0 ? ($record->first()->status_cpp == 'Putra Ketiga' ? 'selected':''):'' }} value="Putra Ketiga">Putra Ketiga</option>
                        <option {{ $record->count() > 0 ? ($record->first()->status_cpp == 'Putra Keempat' ? 'selected':''):'' }} value="Putra Keempat">Putra Keempat</option>
                        <option {{ $record->count() > 0 ? ($record->first()->status_cpp == 'Putra Kelima' ? 'selected':''):'' }} value="Putra Kelima">Putra Kelima</option>
                    </select>
                </div>
            </div>
            <h4 class="ui dividing header">Informasi CPW (Calon Pengantin Wanita)</h4>
            <div class="four fields">
                <div class="field">
                    <label>Nama CPW</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->cpw:'' }}" name="cpw" placeholder="Nama CPW">
                </div>
                <div class="field">
                    <label>Nama Bapak CPW</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->bpk_cpw:'' }}" name="bpk_cpw" placeholder="Nama Bapak CPW">
                </div>
                <div class="field">
                    <label>Nama Ibu CPW</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->ibu_cpw:'' }}" name="ibu_cpw" placeholder="Nama Ibu CPW">
                </div>
                <div class="field">
                    <label>Status CPW</label>
                    <select class="ui fluid search dropdown" name="status_cpw">
                        <option value="">Choose One</option>
                        <option {{ $record->count() > 0 ? ($record->first()->status_cpw == 'Putri Tunggal' ? 'selected':''):'' }} value="Putri Tunggal">Putri Tunggal</option>
                        <option {{ $record->count() > 0 ? ($record->first()->status_cpw == 'Putri Pertama' ? 'selected':''):'' }} value="Putri Pertama">Putri Pertama</option>
                        <option {{ $record->count() > 0 ? ($record->first()->status_cpw == 'Putri Kedua' ? 'selected':''):'' }} value="Putri Kedua">Putri Kedua</option>
                        <option {{ $record->count() > 0 ? ($record->first()->status_cpw == 'Putri Ketiga' ? 'selected':''):'' }} value="Putri Ketiga">Putri Ketiga</option>
                        <option {{ $record->count() > 0 ? ($record->first()->status_cpw == 'Putri Keempat' ? 'selected':''):'' }} value="Putri Keempat">Putri Keempat</option>
                        <option {{ $record->count() > 0 ? ($record->first()->status_cpw == 'Putri Kelima' ? 'selected':''):'' }} value="Putri Kelima">Putri Kelima</option>
                    </select>
                </div>
            </div>
            <h4 class="ui dividing header">Alamat Pernikahan</h4>
            <div class="three fields">
                <div class="field">
                    <label>Alamat</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->alamat:'' }}" name="alamat" placeholder="Alamat">
                </div>
                <div class="field">
                    <label>Kelurahan / Desa</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->kelurahan:'' }}" name="kelurahan" placeholder="Kelurahan / Desa">
                </div>
                <div class="field">
                    <label>Kecamantan</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->kecamatan:'' }}" name="kecamatan" placeholder="Kecamantan">
                </div>
            </div>
            <div class="three fields">
                <div class="field">
                    <label>Kota</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->kota:'' }}" name="kota" placeholder="Kota">
                </div>
                <div class="field">
                    <label>Provinsi</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->provinsi:'' }}" name="provinsi" placeholder="Provinsi">
                </div>
                <div class="field">
                    <label>Lokasi Maps</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->lokasi_maps:'' }}" name="lokasi_maps" placeholder="Lokasi Maps">
                </div>
            </div>
            <h4 class="ui dividing header">Detail Pernikahan</h4>
            <div class="three fields">
                <div class="field datetime">
                    <label>Wedding Date</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->wedding_date:'' }}" name="wedding_date" placeholder="Wedding Date" readonly="">
                </div>
                <div class="field">
                    <label>Judul Quotes</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->title_quotes:'' }}" name="title_quotes" placeholder="Judul Quotes">
                </div>
                <div class="field">
                    <label>Quotes</label>
                    <input type="text" value="{{ $record->count() > 0 ? $record->first()->quotes:'' }}" name="quotes" placeholder="Quotes">
                </div>
            </div>
            <h4 class="ui dividing header">No. Rekening</h4>
            <div class="two fields">
                <div class="field">
                    <label>Bank Rekening 1</label>
                    <div class="ui action input">
                        <input type="text" value="{{ $record->count() > 0 ? $record->first()->no_rek:'' }}" name="no_rek" placeholder="Bank Rekening 1">
                        <select name="bank" class="ui compact selection dropdown">
                            <option value="">Choose One</option>
                            <option {{ $record->count() > 0 ? ($record->first()->bank == 'Mandiri' ? 'selected':''):'' }} value="Mandiri">Mandiri</option>
                            <option {{ $record->count() > 0 ? ($record->first()->bank == 'Jago' ? 'selected':''):'' }} value="Jago">Jago</option>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label>Bank Rekening 2</label>
                    <div class="ui action input">
                        <input type="text" value="{{ $record->count() > 0 ? $record->first()->no_rek_2:'' }}" name="no_rek_2" placeholder="Bank Rekening 2">
                        <select name="bank_2" class="ui compact selection dropdown">
                            <option value="">Choose One</option>
                            <option {{ $record->count() > 0 ? ($record->first()->bank_2 == 'Mandiri' ? 'selected':''):'' }} value="Mandiri">Mandiri</option>
                            <option {{ $record->count() > 0 ? ($record->first()->bank_2 == 'Jago' ? 'selected':''):'' }} value="Jago">Jago</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="ui two column grid">
                <div class="left aligned column">
                    {{-- <a class="ui labeled icon button" href="{{ url($pageUrl) }}">
                        <i class="chevron left icon"></i>
                        Back
                    </a> --}}
                </div>
                <div class="right aligned column">
                    <div class="ui positive right labeled icon save as page button">
                        Save
                        <i class="checkmark icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
