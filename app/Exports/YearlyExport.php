<?php

namespace App\Exports;

use App\Models\Notialert;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
class YearlyExport implements FromCollection, WithHeadings, WithEvents,WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $objyear;

    function __construct($requestYear){
        $this->objyear = $requestYear;
        // $this->year = $req->yearMonthArray[1];
    }

    public function collection()
    {

        $year = $this->objyear;
        $yearlyExport =DB::select("select year(created_at) date, 
        count(case when feedback_number = 1 then 1 end) good, 
        count(case when feedback_number = 2 then 1 end) normal, 
        count(case when feedback_number = 3 then 1 end) bad
        from notialerts 
        where year (created_at) = $year
        group by year(created_at)");
        return collect($yearlyExport);
    }
    public function headings() :array
    {
        return[["Yearly feedback reprot"],["Year", "Excellent", "Normal","Bad"]];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(20);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(15);
                $event->sheet->mergeCells('A1:D1');
                // $sheet->setBorder('A1:D1', 'thin');
                $event->sheet->getDelegate()->getStyle('A1:D1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:D1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:D2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                                
                 $event->sheet->getDelegate()->getStyle('A1:D1')
                                ->getFont()
                                ->setBold(true);
                $event->sheet->getDelegate()->getStyle('1')->getFont()->setSize(14);
                 $event->sheet->getStyle('A1:D3')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                 ]);
            },
        ];
    }
}
