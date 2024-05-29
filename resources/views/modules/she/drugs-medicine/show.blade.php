@extends('layouts.form')

@section('styles')

@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function () {
    $('.year_filter').calendar({
      type: 'year',
      onChange: function (date, text, mode) {
        val = text;
        var url = '{{ url($pageUrl.'filter-year/') }}';
        var id = $('#parent_id').val();
        $.ajax({
          url: url+'/'+id+'?year='+val,
          type: "GET",
          processData: false,
          contentType: false,
          success: function(resp){
            $('#showData').html(resp);
          },
          error : function(resp){
          },
        });
      }
    });
  });
</script>
@endsection

@section('content-body')
<form id="dataForm" action="{{ url($pageUrl.$record->id) }}" class="ui form" method="POST">
  <div class="ui form">
    {!! csrf_field() !!}
    <input type="hidden" id="parent_id" name="id" value="{{ $record->id }}">
    <input type="hidden" name="_method" value="PUT">
    <div class="ui segment">
      <div class="four fields">
        <div class="field">
          <label>Company</label>
          <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->site->name }}" readonly>
        </div>
        <div class="field">
          <label>Tahun</label>
          <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->year }}" readonly>
        </div>
        <div class="field">
          <label>Nama Obat</label>
          <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->medicine->name }}" readonly>
        </div>
        <div class="field">
          <label>Merk Dagang</label>
          <input type="text" name="name" placeholder="Merk Dagang" value="{{ $record->trademark_id ? $record->trademark->name:'' }}" readonly>
        </div>
      </div>
      <div class="four fields">
        <div class="field">
          <label>Sediaan</label>
          <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->unit->name }}" readonly>
        </div>
        <div class="field">
          <label>Route</label>
          <input type="text" name="name" placeholder="Route" value="{{ $record->route ? $record->route->name:'' }}" readonly>
        </div>
        <div class="field">
          <label>Dosis (gr)</label>
          <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->dose }}" readonly>
        </div>
        <div class="field">
          <label>Minimal Stok (pcs)</label>
          <input type="text" name="name" placeholder="Contractor Name" value="{{ $record->min_stock }}" readonly>
        </div>
      </div>
      <br>
      <div class="ui horizontal divider">
        History Transaksi
      </div>
      <div class="two fields">
        <div class="field year_filter">
          <label>Filter Tahun</label>
          <input type="text" name="name" placeholder="Filter Tahun" value="{{ $periode->getEndDate()->format('Y') }}" readonly>
        </div>
        <div class="field">
          <label>Total Stok (pcs)</label>
          <input type="text" name="name" placeholder="Contractor Name" value="{{ $stock }}" readonly>
        </div>
      </div>
      <div id="showData">
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
      </div>
      <br>
      <div class="ui two column grid">
        <div class="left aligned column">
          <a class="ui labeled icon button" href="{{ url($pageUrl) }}">
            <i class="chevron left icon"></i>
            Back
          </a>
        </div>
        <div class="right aligned column">
          {{-- <div class="ui positive right labeled icon save as page button">
            Save
            <i class="checkmark icon"></i>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
