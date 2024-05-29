<div class="ui inverted loading dimmer">
    <div class="ui text loader">Loading</div>
</div>
<div class="ui top attached tabular menu">
    <a class="item active" data-tab="1">Summary</a>
    <a class="item" data-tab="2">Detail</a>
    <a class="item" data-tab="3">Chart</a>
</div>
<div class="ui bottom attached tab segment active" data-tab="1">
    <div class="tableMaster">
        <table class="ui celled table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date Of Observation</th>
                    <th>Location</th>
                    <th>Type Of Hazard</th>
                    <th>Action Taken</th>
                    <th>Observer</th>
                    <th>Company</th>
                    <th>Department</th>
                    <th>PIC Department</th>
                    <th>Status Finding</th>
                    <th>Status Observation</th>
                </tr>
            </thead>
            <tbody class="show-summary">
                @forelse ($record as $key => $data)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ Helpers::DateParse($data->date) }}</td>
                        <td>{{ $data->locations->name }}</td>
                        <td>{{ $data->findingStr() }}</td>
                        <td>{{ $data->action }}</td>
                        <td>{{ $data->observer_name }}</td>
                        <td>{{ $data->site->name }}</td>
                        <td>{{ $data->department->name }}</td>
                        <td>{{ $data->pic->name }}</td>
                        <td>{!! $data->statusLabel() !!}</td>
                        <td>{!! $data->typelabel() !!}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">Data Not Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
    </div>
</div>
<div class="ui bottom attached tab segment" data-tab="2">
    @forelse ($category as $key => $item)
        @if ($key % 2 == 0)
            <div class="two fields">
        @else
            
        @endif
            <div class="field">
                <table class="ui celled table">
                    <thead>
                        <tr>
                            <th colspan="4" class="text-center">{{ $item->name }}</th>
                        </tr>
                        <tr>
                            <th>Category Observation</th>
                            <th>Safe / Aman</th>
                            <th>At Risk / Beresiko</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_nilai = 0;
                            $total_risk = 0;
                            $total_safe = 0;
                        @endphp
                        @forelse ($item->component as $data)
                            <tr>
                                <td id="{{ $data->id }}">{{ $data->desc }}</td>
                                @php
                                    $total_nilai = $total_nilai + $data->obsrv_card_count;
                                    $total_risk = $total_risk + $data->obsrv_card_risk_count;
                                    $total_safe = $total_safe + $data->obsrv_card_safe_count;
                                @endphp
                                <td class="text-center">{{ $data->obsrv_card_safe_count }}</td>
                                <td class="text-center">{{ $data->obsrv_card_risk_count }}</td>
                                <td class="text-center">{{ $data->obsrv_card_count }}</td>
                            </tr>
                        @empty
                            
                        @endforelse
                        <tr>
                            <td></td>
                            <td class="text-center">{{ $total_risk }}</td>
                            <td class="text-center">{{ $total_safe }}</td>
                            <td class="text-center"><b>{{ $total_nilai }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @if ($key % 2 == 0)
            @if($loop->last)
                </div>
            @endif
        @else
            </div>
        @endif
    @empty
        
    @endforelse
</div>
<div class="ui bottom attached tab segment" data-tab="3">
    <div class="ui grid">
        <div class="eight wide column">
            <figure class="highcharts-figure">
                <div id="chart1"></div>
            </figure>
        </div>
        <div class="eight wide column">
            <figure class="highcharts-figure">
                <div id="chart2"></div>
            </figure>
        </div>
        <div class="eight wide column">
            <figure class="highcharts-figure">
                <div id="chart4"></div>
            </figure>
        </div>
        <div class="eight wide column">
            <select id="selectCate">
                @forelse ($category as $key => $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @empty
    
                @endforelse
            </select>
            <figure class="highcharts-figure">
                <div id="chart3"></div>
            </figure>
        </div>
        <div class="eight wide column">
            <figure class="highcharts-figure">
                <div id="chart5"></div>
            </figure>
        </div>
        <div class="eight wide column">
            <select id="selectDepart">
                @forelse ($listDepartment as $key => $depart)
                    <option value="{{ $depart->id }}">{{ $depart->name }}</option>
                @empty
    
                @endforelse
            </select>
            <figure class="highcharts-figure">
                <div id="chart6"></div>
            </figure>
        </div>
    </div>
</div>
<a href="{{ url($pageUrl) }}/monitoring/{{ $searchdata }}/export" target="_blank" rel="noopener noreferrer">
    <button type="button" class="ui fluid blue button">
        <i class="file icon"></i>
        Export Excel
    </button>
</a>