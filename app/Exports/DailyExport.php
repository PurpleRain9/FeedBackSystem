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

class DailyExport implements FromCollection, WithHeadings , WithEvents, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $objmonth;
    protected $objyear;

    function __construct($reqmonth, $reqyear){
        $this->objmonth = $reqmonth;
        $this->objyear = $reqyear;
        // $this->year = $req->yearMonthArray[1];
    }

    public function collection()
    {
        $month = $this->objmonth;
        $year = $this->objyear;

        // dd($month, $year);
        $dailyExport = DB::select("
            select cast(created_at as date) date, 
            count(case when feedback_number = 1 then 1 end) good, 
            count(case when feedback_number = 2 then 1 end) normal, 
            count(case when feedback_number = 3 then 1 end) bad 
            from notialerts 
            where month(created_at) = $month AND year(created_at) = $year
            group by cast(created_at as date);
        ");
        $dai = collect($dailyExport);
        return $dai;
        
        // return collect($dailyExport);
    }
    
    public function headings() :array
    {
        return ["Daily", "Excellent", "Normal","Bad"];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(20);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(30);
                $event->sheet->getDelegate()->getStyle('A1:D1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                                
   
            },
        ];
    }
}
