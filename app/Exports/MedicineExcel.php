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
class MedicineExcel implements FromView, WithStyles, WithColumnWidths, WithDrawings, WithTitle
{
    private $query;
    private $title;

    public function __construct(array $query, $title)
    {
        $this->query = $query;
        $this->title = $title;
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
        $total_data_1 = ($this->query['record']->stock()->orderBy('expire_date','asc')->groupBy('expire_date')->get()->count() > 0 ? $this->query['record']->stock()->orderBy('expire_date','asc')->groupBy('expire_date')->get()->count() : 1);
        $total_data_2 = ($this->query['record']->stock()->orderBy('created_at','asc')->get()->count() > 0 ? $this->query['record']->stock()->orderBy('created_at','asc')->get()->count() : 1);
        
        $total_line_stok = 15 + $total_data_1;
        $last = 2 + $total_line_stok;
        $total_line_history = 1 + $last + $total_data_2;
        $last2 = 2 + $total_line_history;
        $total_last = 1 + $last2 + $total_data_1 + $total_data_2;
        $styles = [
            'B1:B6' => $this->generateStyles(['centered']),
            'C:H' => $this->generateStyles(['vertical-top']),
            'A6:H6' => $this->generateStyles(['centered']),
            // 'B7:H' . $total_line => $this->generateStyles(['all-border']),
            'D2:F2' => $this->generateStyles(['centered', 'font-lg']),
            'B6:H12' => $this->generateStyles(['all-border']),
            'B7:H12' => $this->generateStyles(['leftaligment']),
            'D10:H12' => $this->generateStyles(['centered']),
            'B14:H'.$total_line_stok => $this->generateStyles(['centered','all-border']),
            
            'B'.$last.':H'.$total_line_history => $this->generateStyles(['centered','all-border']),

            'B'.$last2.':H'.$total_last => $this->generateStyles(['centered','all-border']),
        ];

        $sheet->getStyle('A:J')->getAlignment()->setWrapText(true);

        foreach ($sheet->getRowDimensions() as $rd) {
            $rd->setRowHeight(-1);
        }

        return $styles;
    }
    public function view(): View
    {
        return view('export.excel-medicine-history', $this->query);
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
            'leftaligment' => [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
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
        return 'Obat No. '.$this->title;
    }
}
