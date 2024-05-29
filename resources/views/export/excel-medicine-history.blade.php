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
            <th colspan="2"><b>Nama Obat</b></th>
            <td colspan="5">{{ $record->medicine->name }}</td>
        </tr>
        <tr>
            <th></th>
            <th colspan="2"><b>Merk Dagang</b></th>
            <td colspan="5">{{ $record->trademark_id ? $record->trademark->name:'' }}</td>
        </tr>
        <tr>
            <th></th>
            <th colspan="2"><b>Sediaan</b></th>
            <td colspan="5">{{ $record->unit->name }}</td>
        </tr>
        <tr>
            <th></th>
            <th colspan="2"><b>Dosis (gr)</b></th>
            <td colspan="5">{{ $record->dose }}</td>
        </tr>
        <tr>
            <th></th>
            <th colspan="2"><b>Minimal Stok (pcs)</b></th>
            <td colspan="5">{{ $record->min_stock }}</td>
        </tr>
        <tr>
            <th></th>
            <th colspan="2"><b>Total Stok (pcs)</b></th>
            <td colspan="5">
                @php
                    $insert = $record->stock->where('number_stock',1)->sum('update_stock');
                    $out = $record->stock->where('number_stock',0)->sum('update_stock');
                    $stock = $insert - $out;
                @endphp
                <b>{{ $stock }}</b>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="7"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="7"><b>Data Stok per Waktu Expired</b></td>
        </tr>
        <tr>
            <td></td>
            <td><b>No</b></td>
            <td><b>Waktu Expired</b></td>
            <td colspan="5"><b>Stok</b></td>
        </tr>
        @forelse ($record->stock()->orderBy('expire_date','asc')->groupBy('expire_date')->get() as $key => $item)
            <tr>
                <td></td>
                <td>{{ $key+1 }}</td>
                <td>{{ Helpers::DateToString(Carbon::createFromFormat('Y-m-d', $item->expire_date)) }}</td>
                @php
                    $totalStockByExpire = 0;
                    $searchStock = App\Models\She\MedicineStock::where('medicine_id', $record->id)->whereDate('expire_date', $item->expire_date)->get();
                    if($searchStock->count() > 0){
                        $insert = $searchStock->where('number_stock',1)->sum('update_stock');
                        $out = $searchStock->where('number_stock',0)->sum('update_stock');
                        $totalStockByExpire = $insert - $out;
                    }
                @endphp
                <td colspan="5">{{ $totalStockByExpire }}</td>
            </tr>
        @empty
            <tr>
                <td></td>
                <td colspan="7">Data Tidak Ditemukan</td>
            </tr>
        @endforelse
        
        <tr>
            <td></td>
            <td colspan="7"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="7"><b>Data Histori Transaksi</b></td>
        </tr>
        <tr>
            <td></td>
            <td><b>No</b></td>
            <td><b>Waktu Transaksi</b></td>
            <td><b>Waktu Expired</b></td>
            <td><b>Jenis</b></td>
            <td><b>Jumlah</b></td>
            <td colspan="2"><b>Total Akhir Stok</b></td>
        </tr>
        @forelse ($record->stock()->orderBy('created_at','asc')->get() as $key => $item)
            <tr>
                <td></td>
                <td>{{ $key+1 }}</td>
                <td>{{ Helpers::DateToStringWtime($item->created_at) }}</td>
                <td>{{ Helpers::DateToString(Carbon::createFromFormat('Y-m-d', $item->expire_date)) }}</td>
                <td>{{ $item->number_stock ? 'Re-Stok':'Transaksi' }}</td>
                <td>{{ $item->number_stock ? $item->update_stock:'-'.$item->update_stock }}</td>
                <td colspan="2">{{ $item->last_stock }}</td>
            </tr>
        @empty
            <tr>
                <td></td>
                <td colspan="7">Data Tidak Ditemukan</td>
            </tr>
        @endforelse
        
        <tr>
            <td></td>
            <td colspan="7"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="7"><b>Data Histori per Waktu Expired</b></td>
        </tr>
        <tr>
            <td></td>
            <td><b>No</b></td>
            <td><b>Waktu Expired</b></td>
            <td><b>Waktu Transaksi</b></td>
            <td><b>Jenis</b></td>
            <td><b>Jumlah</b></td>
            <td colspan="2"><b>Total Akhir Stok</b></td>
        </tr>
        @forelse ($record->stock()->orderBy('expire_date','asc')->groupBy('expire_date')->get() as $key => $item)
            <tr>
                <td></td>
                <td>{{ $key+1 }}</td>
                <td>{{ Helpers::DateToString(Carbon::createFromFormat('Y-m-d', $item->expire_date)) }}</td>
                @php
                    $totalStockByExpire = 0;
                    $searchStock = App\Models\She\MedicineStock::where('medicine_id', $record->id)->whereDate('expire_date', $item->expire_date)->get();
                    if($searchStock->count() > 0){
                        $insert = $searchStock->where('number_stock',1)->sum('update_stock');
                        $out = $searchStock->where('number_stock',0)->sum('update_stock');
                        $totalStockByExpire = $insert - $out;
                    }
                @endphp
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2">{{ $totalStockByExpire }}</td>
            </tr>
            @foreach ($searchStock as $subitem)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ Helpers::DateToStringWtime($subitem->created_at) }}</td>
                    <td>{{ $subitem->number_stock ? 'Re-Stok':'Transaksi' }}</td>
                    <td>{{ $subitem->number_stock ? $subitem->update_stock:'-'.$subitem->update_stock }}</td>
                    <td colspan="2"></td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td></td>
                <td colspan="7">Data Tidak Ditemukan</td>
            </tr>
        @endforelse
    </thead>
</table>
