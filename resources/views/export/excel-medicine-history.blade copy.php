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
            <th rowspan="2"></th>
            <th rowspan="2"><b>No</b></th>
            <th rowspan="2"><b>Nama Obat</b></th>
            <th rowspan="2"><b>Merk Dagang</b></th>
            <th rowspan="2"><b>Sediaan</b></th>
            <th rowspan="2"><b>Dosis (gr)</b></th>
            <th rowspan="2"><b>Waktu Expired</b></th>
            <th rowspan="2"><b>Minimal Stok (pcs)</b></th>
            @foreach ($month as $item)
                <th colspan="3"><b>{{ explode(",", Helpers::DateToStringAcc($item))[1] }}</b></th>
            @endforeach
        </tr>
        <tr>
            @foreach ($month as $item)
                <th><b>Transaksi</b></th>
                <th><b>Re-Stok</b></th>
                <th><b>Sisa Stok</b></th>
            @endforeach
        </tr>
        @foreach ($record as $key => $data)
            <tr>
                <td></td>
                <td>{{ $key+1 }}</td>
                <td>{{ $data->medicine->name }}</td>
                <td>{{ $data->trademark_id ? $data->trademark->name:'' }}</td>
                <td>{{ $data->unit->name }}</td>
                <td>{{ $data->dose }}</td>
                <td>-</td>
                <td>{{ $data->min_stock }}</td>
                @foreach ($month as $item)
                    @php
                      $rec = with(clone $data)->stock()->whereBetween('created_at',[$item->copy()->firstOfMonth(),$item->copy()->endOfMonth()]);
                      if(with(clone $rec)->count() > 0){
                        $trans = with(clone $rec)->where('number_stock',0)->sum('update_stock');
                        $restok = with(clone $rec)->where('number_stock',1)->sum('update_stock');
                        $last = with(clone $rec)->orderBy('created_at', 'desc')->first()->last_stock;
                      }else{
                        $trans = 0;
                        $restok = 0;
                        $last = 0;
                      }
                    @endphp
                    <td>{{ $trans }}</td>
                    <td>{{ $restok }}</td>
                    <td>{{ $last }}</td>
                @endforeach
            </tr>
        @endforeach
    </thead>
</table>
