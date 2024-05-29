<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MedicineManageSheetExcel implements WithMultipleSheets
{
    use Exportable;

    private $query;

    public function __construct(array $query)
    {
        $this->query = $query;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new MedicineSummaryExcel($this->query);
        foreach ($this->query['record'] as $key => $value) {
            $sheets[] = new MedicineExcel([
                'routes' => $this->query['routes'],
                'record' => $value,
                'month' => $this->query['month'],
                'title' => $this->query['title'],
                'divisi' => $this->query['divisi'],
                'tgl_berlaku' => $this->query['tgl_berlaku'],
                'periode' => $this->query['periode'],
                'name_file' => $this->query['name_file'],
            ],$key+1);
        }
        return $sheets;
    }
}