<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }

    // 해딩 row 추가, 이차원 배열로 2행으로 만들 수도 있습니다.
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Content',
            'Created At',
            'Updated At',
            'Call'
        ];
    }

    // 각 컬럼의 width 설정.
    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 30,
            'C' => 45,
            'D' => 30,
            'E' => 30,
            'F' => 20,
        ];
    }

    // 스타일도 변경할 수 있습니다.
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
    }
}
