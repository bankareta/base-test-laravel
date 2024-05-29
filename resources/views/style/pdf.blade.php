<style>
    /**
        Set the margins of the page to 0, so the footer and the header
        can be of the full height and width !
        **/
        @page {
            margin: 100px 25px;
        }

    /** Define now the real margins of every page in the PDF **/
    body {
        margin-top: 3cm;
        margin-left: 0cm;
        margin-right: 0cm;
        margin-bottom: 2cm;
        font-style: normal;
    }

    .ui.table.bordered {
        border: solid black 2px;
        border-collapse: collapse;
        width: 100%;
    }

    .ui.table.bordered td {
        border: solid black 1px;
        border-collapse: collapse;
        padding:10px;
    }

    .ui.table.bordered td img {
        padding: 10px;
    }

    .ui.table.bordered td.center.aligned {
        text-align : center;
    }

    /** Define the header rules **/
    header {
        position: fixed;
        top: -60px;
        left: 0px;
        right: 0px;
        height: 50px;

        /** Extra personal styles **/
        text-align: center;
        line-height: 35px;
    }

    main {
        position: sticky;
        font-size : 12px;
        padding-top : 1cm;
        margin-top : 30px;
        border : solid black 2px;
        width: 100%;
    }

    main p {
        margin-left: 5px;
        margin-right: 5px;
    }

    /** Define the footer rules **/
    footer {
        position: fixed;
        bottom: -60px;
        left: 0px;
        right: 0px;
        height: 50px;

        /** Extra personal styles **/
        text-align: center;
        line-height: 35px;
    }
    .footer .page-number:after {
        content: counter(page);
    }
</style>
