<?php

namespace App\Exports;

use App\Item;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ItemExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithTitle
{
    /**
    * @return Collection
    */
    public function collection()
    {
        return Item::select(['code', 'name', 'qty', 'price', 'cost'])->get();
    }

    public function headings(): array
    {
        return [
            "Item Code",
            "Item Name",
            "Quantity",
            "Price",
            "Cost"
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $to = $sheet->getHighestDataRow();
        for($i = 1; $i <= $to; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(20);
        }

        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12
                ],
            ],
            "A1:E". $to => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                    ],
                ],
            ],
            "A1:A". $to => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                ],
            ],
            "B1:B". $to => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                ],
            ],
            "C1:C". $to => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                ],
            ],
            "D1:D". $to => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                ],
            ],
            "E1:E". $to => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                ],
            ]
        ];
    }

    public function title(): string
    {
        return "Stock - " . Carbon::now()->format('F') . Carbon::now()->format('Y');
    }
}
