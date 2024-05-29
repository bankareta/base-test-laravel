<table class="tbl-header">
    <thead>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th rowspan="3"></th>
            <th rowspan="3" colspan="4"></th>
            <th rowspan="3" colspan="7" style="vertical-align: middle">{{ !isset($title) ? '-' :$title }}</th>
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
            <td colspan="6">{{ $divisi }}</td>
            <td class="text-bold"><b>Periode</b></td>
            <td colspan="2">{{ $periode }}</td>
        </tr>
        <tr>
            <th></th>
            <th><b>No</b></th>
            <th><b>Date Of Observation</b></th>
            <th><b>Location</b></th>
            <th><b>Type Of Hazard</b></th>
            <th><b>Action Taken</b></th>
            <th><b>Observer</b></th>
            <th><b>Company</b></th>
            <th><b>Department Observer</b></th>
            <th><b>PIC Department</b></th>
            <th><b>Status Finding</b></th>
            <th><b>Status Observation</b></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($record as $key => $data)
            <tr>
                <td></td>
                <td>{{ $key+1 }}</td>
                <td>{{ Helpers::DateParse($data->date) }}</td>
                <td>{{ $data->locations->name }}</td>
                <td>{{ $data->findingStr() }}</td>
                <td>{{ $data->action }}</td>
                <td>{{ $data->observer_name }}</td>
                <td>{{ $data->site->name }}</td>
                <td>{{ $data->department->name }}</td>
                <td>{{ $data->pic->name }}</td>
                <td>{{ $data->statusText() }}</td>
                <td>{{ $data->typeText() }}</td>
            </tr>
        @empty
            <tr>
                <td></td>
                <td colspan="8"><h5>Data tidak ditemukan</h5></td>
            </tr>
        @endforelse
    </tbody>
</table>

@forelse ($category as $key => $item)
    <table>
        <thead>
            <tr>
                <th></th>
                <th colspan="3"><b>{{ $item->name }}</b></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th><b>Category Observation</b></th>
                <th><b>Safe / Aman</b></th>
                <th><b>At Risk / Beresiko</b></th>
                <th><b>Total</b></th>
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
                    <td></td>
                    <td></td>
                    <td>{{ $data->abbreviation }}</td>
                    <td class="text-center">{{ $data->obsrv_card_safe_count }}</td>
                    <td class="text-center">{{ $data->obsrv_card_risk_count }}</td>
                    <td>{{ $data->obsrv_card_count }}</td>
                </tr>
                @php
                    $total_nilai = $total_nilai + $data->obsrv_card_count;
                    $total_risk = $total_risk + $data->obsrv_card_risk_count;
                    $total_safe = $total_safe + $data->obsrv_card_safe_count;
                @endphp
            @empty
                
            @endforelse
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center">{{ $total_risk }}</td>
                <td class="text-center">{{ $total_safe }}</td>
                <td>{{ $total_nilai }}</td>
            </tr>
        </tbody>
    </table>
@empty
    
@endforelse