<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithTitle;
class MedicineSummaryExcel implements FromView, WithStyles, WithColumnWidths, WithDrawings, WithTitle
{
    private $query;

    public function __construct(array $query)
    {
        $this->query = $query;
    }

    public function columnWidths(): array
    {
        return [
            'B' => 5,
            'C' => 35,
            'D' => 30,
            'E' => 15,
            'F' => 15,
            'G' => 15,
            'H' => 15,
        ];
    }
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Supreme Energy');
        $drawing->setPath(public_path('img/icon-long.png'));
        $drawing->setHeight(60);
        $drawing->setCoordinates('C2');

        return $drawing;
    }

    public function styles(Worksheet $sheet)
    {
        $total_line = 7 + ($this->query['record']->count() > 0 ? $this->query['record']->count() : 1);

        $styles = [
            'B1:B'.$total_line => $this->generateStyles(['centered']),
            'C:H' => $this->generateStyles(['vertical-top']),
            'A7:H'.$total_line => $this->generateStyles(['centered']),

            'B7:H' . $total_line => $this->generateStyles(['all-border']),

            'D2:F2' => $this->generateStyles(['centered', 'font-lg']),
            'B6:H8' => $this->generateStyles(['all-border', 'centered']),
        ];

        $sheet->getStyle('A:H')->getAlignment()->setWrapText(true);

        foreach ($sheet->getRowDimensions() as $rd) {
            $rd->setRowHeight(-1);
        }

        return $styles;
    }
    public function view(): View
    {
        return view('export.excel-medicine', $this->query);
    }

    public function generateStyles($input)
    {
        $styles = [
            'centered' => [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
            'vertical-top' => [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                ],
            ],
            'font-lg' => [
                'font' => ['size' => 18]
            ],
            'all-border' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],
            'outline-border' => [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],
        ];

        $return = [];

        foreach ($input as $style) {
            $return = array_merge($return, $styles[$style]);
        }

        return $return;
    }
    
    public function title(): string
    {
        return 'Summary';
    }
}
