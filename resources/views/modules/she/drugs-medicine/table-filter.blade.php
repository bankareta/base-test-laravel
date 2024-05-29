<table class="ui celled table">
    <thead>
      <tr class="text-center">
        <th>Bulan</th>
        <th>Restok</th>
        <th>Transaksi</th>
        <th>Total Stok Terakhir</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($periode as $key => $item)
          <tr>
            <td data-label="Name"><b>{{ explode(",", Helpers::DateToStringAbb($item))[1] }}</b></td>
            <td class="text-center" data-label="Age"><b>{{ with(clone $record)->stock()->whereBetween('created_at',[$item->copy()->firstOfMonth(),$item->copy()->endOfMonth()])->where('number_stock',1)->sum('update_stock') }}</b></td>
            <td class="text-center" data-label="Job"><b>{{ with(clone $record)->stock()->whereBetween('created_at',[$item->copy()->firstOfMonth(),$item->copy()->endOfMonth()])->where('number_stock',0)->sum('update_stock') }}</b></td>
            @php
                $data = with(clone $record)->stock()->whereBetween('created_at',[$item->copy()->firstOfMonth(),$item->copy()->endOfMonth()]);
                if(with(clone $data)->count() > 0){
                  $last = with(clone $data)->orderBy('created_at', 'desc')->first()->last_stock;
                }else{
                  $last = 0;
                }
            @endphp
            <td class="text-center" data-label="Job"><b>{{ $last }}</b></td>
          </tr>
          @php
              $detailStock = with(clone $record)->stock()->whereBetween('created_at',[$item->copy()->firstOfMonth(),$item->copy()->endOfMonth()])->get();
          @endphp
          @forelse ($detailStock as $subitem)
            <tr>
              <td data-label="Name">&nbsp; {{ Helpers::DateToStringWtime($subitem->created_at) }}</td>
              <td class="text-center" data-label="Age">{{ $subitem->number_stock == 1 ? $subitem->update_stock:0 }}</td>
              <td class="text-center" data-label="Job">{{ $subitem->number_stock == 0 ? $subitem->update_stock:0 }}</td>
              @php
                  $data = with(clone $record)->stock()->whereBetween('created_at',[$item->copy()->firstOfMonth(),$item->copy()->endOfMonth()]);
                  if(with(clone $data)->count() > 0){
                    $last = with(clone $data)->orderBy('created_at', 'desc')->first()->last_stock;
                  }else{
                    $last = 0;
                  }
              @endphp
              <td class="text-center" data-label="Job"></td>
            </tr>
          @empty
              
          @endforelse
        @endforeach
        <tr class="text-center">
          <td colspan="3"><b>Stok Tersedia</b></td>
          <td><b>{{ $stock }}</b></td>
        </tr>
    </tbody>
</table>