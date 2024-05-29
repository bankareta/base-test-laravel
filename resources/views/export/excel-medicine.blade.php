<table class="tbl-header">
    <thead>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th rowspan="3"></th>
            <th rowspan="3" colspan="2"></th>
            <th rowspan="3" colspan="5" style="vertical-align: middle">{{ !isset($title) ? '-' :$title }}</th>
            <th colspan="2"></th>
            <th></th>
        </tr>
        <tr>
            <th colspan="2"></th>
            <th></th>
        </tr>
        <tr>
            <th colspan="2"></th>
            <th></th>
        </tr>
    </thead>
</table>
 
<table>
    <thead>
        <tr>
            <td></td>
            <td colspan="2" class="text-bold"><b>Company</b></td>
            <td colspan="3">{{ $divisi }}</td>
            <td class="text-bold"><b>Periode</b></td>
            <td>{{ $periode }}</td>
        </tr>
        <tr>
            <th></th>
            <th><b>No</b></th>
            <th><b>Nama Obat</b></th>
            <th><b>Merk Dagang</b></th>
            <th><b>Sediaan</b></th>
            <th><b>Dosis (gr)</b></th>
            <th><b>Minimal Stok (pcs)</b></th>
            <th><b>Total Stok (pcs)</b></th>
        </tr>
        @foreach ($record as $key => $data)
            <tr>
                <td></td>
                <td>{{ $key+1 }}</td>
                <td>{{ $data->medicine->name }}</td>
                <td>{{ $data->trademark_id ? $data->trademark->name:'' }}</td>
                <td>{{ $data->unit->name }}</td>
                <td>{{ $data->dose }}</td>
                <td>{{ $data->min_stock }}</td>
                <td>
                    @php
                        $insert = $data->stock->where('number_stock',1)->sum('update_stock');
                        $out = $data->stock->where('number_stock',0)->sum('update_stock');
                        $stock = $insert - $out;
                    @endphp
                    {{ $stock }}
                </td>
            </tr>
        @endforeach
    </thead>
</table>
