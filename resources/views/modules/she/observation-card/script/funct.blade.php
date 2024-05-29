<script>
    function searchData(start_date,end_date,site_id,type) {
        var url = "{{ url($pageUrl) }}/post-monitoring";
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                '_method' : 'POST',
                '_token' : '{{ csrf_token() }}',
                'start_date': start_date,
                'end_date': end_date,
                'site_id': site_id,
                'type': type,
            }
        })
        .done(function(response) {
            $('.showData').html(response);
            $('.tabular.menu .item').tab();
        })
        .fail(function(response) {
            
        })
    }
    function searchChart(start_date,end_date,site_id,id,type) {
        var url = "{{ url($pageUrl) }}/post-monitoring";
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                '_method' : 'POST',
                '_token' : '{{ csrf_token() }}',
                'start_date': start_date,
                'end_date': end_date,
                'site_id': site_id,
                'type': type,
                'val':id
            }
        })
        .done(function(response) {
            switch (response.type) {
                case 'refresh-chart':
                    resp = response;
                    const categorys = new Highcharts.chart('chart3', {
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: resp.chart3.title,
                        },
                        subtitle: {
                        },
                        xAxis: {
                            categories: resp.chart3.categories,
                            title: {
                                text: null
                            }
                        },
                        yAxis: {
                            min: 0,
                            labels: {
                                overflow: 'justify'
                            }
                        },
                        tooltip: {
                            valueSuffix: ''
                        },
                        plotOptions: {
                            bar: {
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -40,
                            y: 80,
                            floating: true,
                            borderWidth: 1,
                            backgroundColor:
                                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                            shadow: true
                        },
                        credits: {
                            enabled: false
                        },
                        series: [{
                            showInLegend: false,
                            name: 'Total',
                            data: resp.chart3.data
                        }]
                    });
                    categorys.redraw();
                break;

                case 'refresh-chart-depart':
                    resp = response;
                    const categorys2 = new Highcharts.chart('chart6', {
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: resp.chart6.title,
                        },
                        subtitle: {
                        },
                        xAxis: {
                            categories: resp.chart6.categories,
                            title: {
                                text: null
                            }
                        },
                        yAxis: {
                            min: 0,
                            labels: {
                                overflow: 'justify'
                            }
                        },
                        tooltip: {
                            valueSuffix: ''
                        },
                        plotOptions: {
                            bar: {
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -40,
                            y: 80,
                            floating: true,
                            borderWidth: 1,
                            backgroundColor:
                                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                            shadow: true
                        },
                        credits: {
                            enabled: false
                        },
                        series: [{
                            showInLegend: false,
                            name: 'Total Observed',
                            data: resp.chart6.data
                        },{
                            showInLegend: false,
                            name: 'Total Finding',
                            data: resp.chart6.dataFinding
                        },{
                            showInLegend: false,
                            name: 'Total Finding Safe',
                            data: resp.chart6.dataSafe
                        },{
                            showInLegend: false,
                            name: 'Total Finding At Risk',
                            data: resp.chart6.dataRisk
                        }]
                    });
                    categorys2.redraw();
                break;
            
                default:
                    showChart(response);
                break;
            }
        })
        .fail(function(response) {
            
        })
    }
    function showChart(resp) {
        new Highcharts.chart('chart1', {
            chart: {
                styledMode: true
            },
            title: {
                text: 'Type Of Observation'
            },
            xAxis: {

            },
            credits: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                data: resp.chart1.data,
                name: 'Total',
                showInLegend: true
            }]
        });

        new Highcharts.chart('chart2', {
            chart: {
                styledMode: true
            },
            title: {
                text: 'Status Finding'
            },
            xAxis: {

            },
            credits: {
                enabled: false
            },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: resp.chart2.data,
                name: 'Total',
                showInLegend: true
            }]
        });

        new Highcharts.chart('chart3', {
            chart: {
                type: 'bar'
            },
            title: {
                text: resp.chart3.title,
            },
            subtitle: {
            },
            xAxis: {
                categories: resp.chart3.categories,
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                showInLegend: false,
                name: 'Total',
                data: resp.chart3.data
            }]
        });

        new Highcharts.chart('chart4', {
            chart: {
                type: 'bar'
            },
            title: {
                text: resp.chart4.title,
            },
            subtitle: {
            },
            xAxis: {
                categories: resp.chart4.categories,
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                showInLegend: false,
                name: 'Total',
                data: resp.chart4.data
            }]
        });

        new Highcharts.chart('chart5', {
            chart: {
                type: 'bar'
            },
            title: {
                text: resp.chart5.title,
            },
            subtitle: {
            },
            xAxis: {
                categories: resp.chart5.categories,
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                showInLegend: false,
                name: 'Total',
                data: resp.chart5.data
            }]
        });

        new Highcharts.chart('chart6', {
            chart: {
                type: 'bar'
            },
            title: {
                text: resp.chart6.title,
            },
            subtitle: {
            },
            xAxis: {
                categories: resp.chart6.categories,
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                showInLegend: false,
                name: 'Total Observed',
                data: resp.chart6.data
            },{
                showInLegend: false,
                name: 'Total Finding',
                data: resp.chart6.dataFinding
            },{
                showInLegend: false,
                name: 'Total Finding Safe',
                data: resp.chart6.dataSafe
            },{
                showInLegend: false,
                name: 'Total Finding At Risk',
                data: resp.chart6.dataRisk
            }]
        });
    }
</script>