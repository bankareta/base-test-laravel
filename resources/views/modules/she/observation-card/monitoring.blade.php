@extends('layouts.monitoring')

@section('styles')
<style type="text/css">

.highcharts-pie-series .highcharts-point {
    stroke: #ede;
    stroke-width: 2px;
}

.highcharts-pie-series .highcharts-data-label-connector {
    stroke: silver;
    stroke-dasharray: 2, 2;
    stroke-width: 2px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 320px;
    max-width: 600px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        closeSidebar();
        $(document).on('click', '.searchMonitoring', function(e){
            var site_id = $('#company').val();
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            if((site_id == '') || (startDate == '') || (endDate == '')){
                swal({
                    title: "Filter Required",
                    text: "Company and Month is Required",
                    type: 'error',
                    allowOutsideClick: false
                }).then((res) => {

                })
            }else{
                $('.showData').find('.loading.dimmer').addClass('active');
                searchData(startDate,endDate,site_id,'master');
                searchChart(startDate,endDate,site_id,0,'chart');
                $('.showData').find('.loading.dimmer').removeClass('active');
            }
        });
        $(document).on('change', '#selectCate', function(e){
            var val = $('#selectCate option:selected').val();
            var site_id = $('#company').val();
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            searchChart(startDate,endDate,site_id,val,'refresh-chart');
        });
        
        $(document).on('change', '#selectDepart', function(e){
            var val = $('#selectDepart option:selected').val();
            var site_id = $('#company').val();
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            searchChart(startDate,endDate,site_id,val,'refresh-chart-depart');
        });
    });
</script>
@include('modules.she.observation-card.script.funct')
@endsection

@section('content-body')
<div class="ui form">
    {!! csrf_field() !!}
    <div class="ui segment">
        <div class="inline fields">
            <div class="field">
                <select id="company" name="filter[company]" class="ui fluid search dropdown">
                    {!! App\Models\Master\Site::options('name','id',[
                        'filters' => [
                        function ($site) {
                            $site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
                            },
                        ]
                    ], 'Choose Company') !!}
                </select>
            </div>
            <div class="field monthRangeDate">
                <input type="text" placeholder="Month Date" name="month" readonly>
            </div>
            <div class="field startdate">
                <input type="text" placeholder="Start Date" id="startDate" name="month" readonly>
            </div>
            <div class="field enddate">
                <input type="text" placeholder="End Date" id="endDate" name="month" readonly>
            </div>
            <div style="margin-left: auto; margin-right: 1px;">
                <button type="button" class="ui blue button searchMonitoring">
                    <i class="search icon"></i>
                    Search Data
                </button>
            </div>
        </div>
        <div class="showData">
            <div class="ui inverted loading dimmer">
                <div class="ui text loader">Loading</div>
            </div>
            <div class="ui top attached tabular menu">
                <a class="item active" data-tab="1">Summary</a>
                <a class="item" data-tab="2">Detail</a>
                <a class="item" data-tab="3">Chart</a>
            </div>
            <div>
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
                                <td colspan="11" class="text-center">Data Not Found</td>
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
                                        @forelse ($item->component as $data)
                                            <tr>
                                                <td id="{{ $data->id }}">{{ $data->desc }}</td>
                                                <td class="text-center">0</td>
                                                <td class="text-center">0</td>
                                                <td class="text-center">0</td>
                                            </tr>
                                        @empty
                                            
                                        @endforelse
                                        <tr>
                                            <td></td>
                                            <td class="text-center"><b>0</b></td>
                                            <td class="text-center"><b>0</b></td>
                                            <td class="text-center"><b>0</b></td>
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
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
