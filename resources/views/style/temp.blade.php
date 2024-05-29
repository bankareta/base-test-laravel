<script type="text/php">
    if (isset($pdf)) {
        $font = $fontMetrics->getFont("Times New Romans", "bold");
        $pdf->page_text(20, 820, "No. Formulir : -", $font, 10, array(0, 0, 0));
        $pdf->page_text(510, 820, "Halaman {PAGE_NUM} dari {PAGE_COUNT}", $font, 10, array(0, 0, 0));
        $pdf->page_text(20, 10, "Diunduh Oleh : {{auth()->user()->username}}", $font, 10, array(0, 0, 0));
        $pdf->page_text(440, 10, "Tanggal diunduh : {{$today}}", $font, 10, array(0, 0, 0));
    }
</script>
<header>
    <table class="ui table bordered" style="font-size: 13px">
        <tr>
            <td class="center aligned" colspan="2">{{ $title }}</td>
        </tr>
    </table>
</header>