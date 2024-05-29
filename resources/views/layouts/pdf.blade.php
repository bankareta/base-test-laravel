<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ !isset($name_file) ? '-' :$name_file }}</title>  
    @stack('css')
	<style>
    @page {
        margin: 30px 25px;
    }

	body {
        margin: 87px 0px 0px 0px;
        font-family: "Arial Narrow", Arial, sans-serif;
    }
    h3{
        font-size: 14px;
  		text-justify: inter-word;
    }
    h4{
        font-size: 12px;
        margin: 0px 0px 0px 0px;
  		text-justify: inter-word;
    }
    .no-margin{
        margin: 0px 0px 0px 0px;
  		text-justify: inter-word;
    }
    .no-padding{
        padding: 0px 0px 0px 0px;
  		text-justify: inter-word;
    }
    p{
        font-size: 10px;
        margin: 1px 0px 0px 0px;
    }
	.partial{
		-webkit-region-break-inside: avoid;
		position: relative;
		page-break-inside: avoid;
	}
	.page-break {
        page-break-after: always;
    }
    table {
        width: 100%;
        table-layout:fixed;
        text-align: left;
        border-collapse: collapse;
        font-family: "Arial Narrow", Arial, sans-serif;
    }
    td,th{
        border: 1px solid black;
    }
    table, td, th {
        font-size: 10px;
    }
    td, th{
        padding: 2px 2px 2px 2px;
    }
    .tbl-header{
        position: fixed;
        top: -10px;
        bottom: 0px;
        width: 100%;
        table-layout:fixed;
        page-break-inside: auto;
    }
    .text-center{
        text-align: center;
    }
    .text-left{
        text-align: left;
    }
    .text-right{
        text-align: right;
    }
    .text-bold{
        font-weight: bold;
    }
    .no-border{
        border: 0px !important; 
    }
    .img-content{
        margin-top: 12px;
    }
    .dont-break-me{
        page-break-inside: avoid;
    }
        /* Create four equal columns that floats next to each other */
    .row{
        width: 100%;
    }
    .side-by-side {
        float:left;
        width: 49%
    }
    td{
        /* vertical-align: top; */
    }
</style>

@stack('style')
</head>
<body>
    @section('script')
        <script type="text/php">
            if (isset($pdf)) {
                $font = $fontMetrics->getFont("sans-serif", "");
                $pdf->page_text(510, 820, "Halaman {PAGE_NUM} dari {PAGE_COUNT}", $font, 7, array(0, 0, 0));
            }
        </script>
    @show
    @section('headers')
    <table class="tbl-header">
        <thead>
            <tr>
                <th style="width:25%" class="text-center"><img src="{{ public_path('img/icon-long.png') }}" alt="image" width="180"></th>
                <th style="width:50%" class="text-center"><h3>{!! !isset($header) ? 'SAFETY, HEALTH, AND ENVIRONMENT WORKPLACE HEALTH & HYGIENE' :$header !!}</h3></th>
                <td class="text-bold text-center"><h3>{!! !isset($form) ? 'FORM':$form !!}</h3></td>
            </tr>
            <tr>
                <td class="text-center"><h3>{!! !isset($sub_1) ? 'CORPORATE':$sub_1 !!}</h3></td>
                <td class="text-center"><h3>{!! !isset($title) ? '-':$title !!}</h3></td>
                <td>
                    <h4>{!! !isset($no_doc) ? 'SE-MSHE-WHH-PRO-0001':$no_doc !!}</h4>
                    <h4>Revision: {!! !isset($revision) ? '1 (Draft)':$revision !!}</h4>
                </td>
            </tr>
        </thead>
    </table>
    @show
    
    @section('data-content')
        <div class="content" style="margin-top: 50px">
            @yield('content')
        </div>
    @show
    @stack('js')
</body>
</html>
