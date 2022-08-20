<?php

namespace App\Http\Controllers;

use App\Models\Notialert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class NotiAlertController extends Controller
{
    //For Feedback view
    public function view()
    {
        return view('web-page-noti');
    }

    // For Feedback save
    public function create(Request $request)
    {
        $request->validate([
            'feedback' => 'required'
        ]);
        $feedback = new Notialert();
        $feedback->feedback_number = $request->feedback;
        $feedback->save();
        return redirect()->back();
    }

    // For Feedback count
    public function showData()
    { 
        /* For Monthly All Chart */
        // For Chart Data
        
        $feedbackChartOne = Notialert::select(DB::raw("COUNT(*) as count"))
             ->where('feedback_number', '=', 1)
            ->whereYear("created_at", date("Y"))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
            // dd($feedbackChartOne);
        $feedbackChartTwo = Notialert::select(DB::raw("COUNT(*) as count"))
            ->where('feedback_number', '=', 2)
            ->whereYear("created_at", date("Y"))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        $feedbackChartThree = Notialert::select(DB::raw("COUNT(*) as count"))
            ->where('feedback_number', '=', 3)
            ->whereYear("created_at", date("Y"))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        // dd($feedbackChartOne);

        $monthlyGood = DB::select("select month(created_at)name, monthname(created_at) name, 
        count(case when feedback_number = 1 then 1 end) value
        from notialerts 
        group by month(created_at), monthname(created_at)
        order by month(created_at)");
        $mg = [];
        foreach ($monthlyGood  as $key => $value) {
            $mg_sub = [];
            $mg_sub[0] = $value->name;
            $mg_sub[1] = $value->value;
            $mg[] = $mg_sub;
        }
        $monthlyGood = collect($mg);


        $monthlyNormal = DB::select("select month(created_at)name, monthname(created_at) name, 
        count(case when feedback_number = 2 then 1 end) value
        from notialerts 
        group by month(created_at), monthname(created_at)
        order by month(created_at)");
        $mn = [];
        foreach ($monthlyNormal  as $key => $value) {
            $mn_sub = [];
            $mn_sub[0] = $value->name;
            $mn_sub[1] = $value->value;
            $mn[] = $mn_sub;
        }
        $monthlyNormal = collect($mn);


        // dd($monthlyNormal);

        $monthlyBad = DB::select("select month(created_at)name, monthname(created_at) name, 
        count(case when feedback_number = 3 then 1 end) value
        from notialerts 
        group by month(created_at), monthname(created_at)
        order by month(created_at)");
        $mb = [];
        foreach ($monthlyBad as $key => $value){
            $mb_sub = [];
            $mb_sub[0] = $value->name;
            $mb_sub[1] = $value->value;
            $mb[] = $mb_sub;
        }
        $monthlyBad = collect($mb);


        /* For Daily All Chart */
        $yr = Carbon::now()->year;
        $mt = Carbon::now()->month;

        $date = DB::select("select cast(created_at as date) date
        from notialerts 
        where month(created_at) = $mt  AND year(created_at) = $yr
        group by cast(created_at as date)");
        // dd($date);
        $da = [];
        foreach ($date  as $key => $value) {
            $da_sub = [];
            $da_sub[0] = $value->date;
            
            $da[] = $da_sub;
        }
        $date = collect($da);

        // dd($date);
        
        
        $DaliyChartOne = DB::select("select cast(created_at as date) date, 
        count(case when feedback_number = 1 then 1 end) good 
        from notialerts where month(created_at) = $mt AND year(created_at) = $yr 
        group by cast(created_at as date);");
        $done = [];
        foreach ($DaliyChartOne as $key => $value) {
            $done_sub = [];
            $done_sub[0] = $value->date;
            $done_sub[1] = $value->good;
            $done[] = $done_sub;
        }
        $DaliyChartOne = collect($done);

        // dd($DaliyChartOne);

        $DaliyChartTwo =  DB::select("select cast(created_at as date) date, 
        count(case when feedback_number = 2 then 1 end) normal 
        from notialerts where month(created_at) = $mt AND year(created_at) = $yr
        group by cast(created_at as date);");
        $dtwo = [];
        foreach ($DaliyChartTwo as $key => $value){
            $dtwo_sub =[];
            $dtwo_sub[0] = $value->date;
            $dtwo_sub[1] = $value->normal;
            $dtwo[] = $dtwo_sub;
        }
        $DaliyChartTwo = collect($dtwo);
        // dd($DaliyChartTwo);


        $DaliyChartThree =  DB::select("select cast(created_at as date) date, 
        count(case when feedback_number = 3 then 1 end) bad 
        from notialerts where month(created_at) = $mt AND year(created_at) = $yr
        group by cast(created_at as date);");
            // dd($DaliyChartThree);
        $dthree = [];
        foreach ($DaliyChartThree as $key => $value){
            $dthree_sub = [];
            $dthree_sub[0] = $value->date;
            $dthree_sub[1] = $value->bad;
            $dthree[] = $dthree_sub;
        }
        $DaliyChartThree = collect($dthree);


        /* For Yearly All Chart */
        $yearOnly = Carbon::now()->year;
        $yearDate = DB::select("select year(created_at) date from notialerts group by year(created_at);");
        $y=[];
        foreach ($yearDate  as $key => $value) {
            $y_sub = [];
            $y_sub[0] = $value->date;
            
            $y[] = $y_sub;
        }
        $yearDate = collect($y);
        // dd($yearDate);

        $yearlyChartOne = DB::select('select year(created_at) date, 
        count(case when feedback_number = 1 then 1 end) good 
        from notialerts group by year(created_at);');
        $yone= []; // outer array
        foreach ($yearlyChartOne as $key => $value){
            // $yone_sub =[]; // inner array, 2 elements
            // $yone_sub[0] = $value->date;
            $yone[] = $value->good;
            // $yone[] = $yone_sub;
        }
        $yearlyChartOne = collect($yone);
        // dd($yearlyChartOne);
        // dd($yearlyChartOne);
        $yearlyCharTwo = DB::select('select year(created_at) date, 
        count(case when feedback_number = 2 then 1 end) normal
        from notialerts group by year(created_at);');
        $ytwo= []; // outer array
        foreach ($yearlyCharTwo as $key => $value){
            // $yone_sub =[]; // inner array, 2 elements
            // $yone_sub[0] = $value->date;
            $ytwo[] = $value->normal;
            // $yone[] = $yone_sub;
        }
        $yearlyCharTwo = collect($ytwo);

        $yearlyCharThree = DB::select('select year(created_at) date, 
        count(case when feedback_number = 3 then 1 end) bad
        from notialerts group by year(created_at);');
        $ythree= []; // outer array
        foreach ($yearlyCharThree as $key => $value){
            // $yone_sub =[]; // inner array, 2 elements
            // $yone_sub[0] = $value->date;
            $ythree[] = $value->bad;
            // $yone[] = $yone_sub;
        }
        $yearlyCharThree = collect($ythree);

        $yearlyChartOne = DB::select('select year(created_at) date, 
        count(case when feedback_number = 1 then 1 end) good 
        from notialerts group by year(created_at);');
        $yone= []; // outer array
        foreach ($yearlyChartOne as $key => $value){
            // $yone_sub =[]; // inner array, 2 elements
            // $yone_sub[0] = $value->date;
            $yone[] = $value->good;
            // $yone[] = $yone_sub;
        }
        $yearlyChartOne = collect($yone);

        $yearlyPieCharOne = DB::select('select year(created_at) date, 
        count(case when feedback_number = 1 then 1 end) good
        from notialerts group by year(created_at);');
        $yPieOne= []; // outer array
        foreach ($yearlyPieCharOne as $key => $value){
            $yPieOne_sub =[]; // inner array, 2 elements
            $yPieOne_sub[0] = $value->date;
            $yPieOne_sub[1] = $value->good;
            $yPieOne[] = $yPieOne_sub;
        }
        $yearlyPieCharOne = collect($yPieOne);
        // dd($yearlyPieCharOne);

        $yearlyPieCharTwo = DB::select('select year(created_at) date, 
        count(case when feedback_number = 2 then 1 end) normal
        from notialerts group by year(created_at);');
        $yPieTwo= []; // outer array
        foreach ($yearlyPieCharTwo as $key => $value){
            $yPieTwo_sub =[]; // inner array, 2 elements
            $yPieTwo_sub[0] = $value->date;
            $yPieTwo_sub[1] = $value->normal;
            $yPieTwo[] = $yPieTwo_sub;
        }
        $yearlyPieCharTwo = collect($yPieTwo);
        // dd($yearlyPieCharTwo);
        
        $yearlyPieCharThree = DB::select('select year(created_at) date, 
        count(case when feedback_number = 3 then 1 end) bad
        from notialerts group by year(created_at);');
        $yPieThree= []; // outer array
        foreach ($yearlyPieCharThree as $key => $value){
            $yPieThree_sub =[]; // inner array, 2 elements
            $yPieThree_sub[0] = $value->date;
            $yPieThree_sub[1] = $value->bad;
            $yPieThree[] = $yPieThree_sub;
        }
        $yearlyPieCharThree = collect($yPieThree);
       



        $yearly = DB::select('select year(created_at) date, 
        count(case when feedback_number = 1 then 1 end) good, 
        count(case when feedback_number = 2 then 1 end) normal, 
        count(case when feedback_number = 3 then 1 end) bad
        from notialerts group by year(created_at)');
        
        $monthly = DB::select('select month(created_at) date, monthname(created_at) date, 
        count(case when feedback_number = 1 then 1 end) good, 
        count(case when feedback_number = 2 then 1 end) normal, 
        count(case when feedback_number = 3 then 1 end) bad 
        from notialerts 
        group by month(created_at), monthname(created_at)
        order by month(created_at)');

        $dailies = DB::select('select cast(created_at as date) date, 
        count(case when feedback_number = 1 then 1 end) good, 
        count(case when feedback_number = 2 then 1 end) normal, 
        count(case when feedback_number = 3 then 1 end) bad 
        from notialerts group by cast(created_at as date)');

        return view('web-count-noti', compact(
            'dailies',
            'monthly',
            'yearly',
            'feedbackChartOne',
            'feedbackChartTwo',
            'feedbackChartThree',
            'monthlyGood',
            'monthlyNormal',
            'monthlyBad',
            'date',
            'DaliyChartOne',
            'DaliyChartTwo',
            'DaliyChartThree',
            'yearDate',
            'yearlyChartOne',
            'yearlyCharTwo',
            'yearlyCharThree',
            'yearlyPieCharOne',
            'yearlyPieCharTwo',
            'yearlyPieCharThree'

        ));
    }
    public function fromtoSearch(Request $request)
    {
        $monthlySearch = DB::select("select month(created_at) date, monthname(created_at) date, 
            count(case when feedback_number = 1 then 1 end) good, 
            count(case when feedback_number = 2 then 1 end) normal, 
            count(case when feedback_number = 3 then 1 end) bad 
            
            from notialerts 
            where year(created_at) = $request->yearVal
            group by month(created_at), monthname(created_at)
            order by month(created_at)");
        return response()->json($monthlySearch);
    }

    public function dailySearch(Request $request)
    {
        $year = $request->yearMonthArray[0];
        $month = $request->yearMonthArray[1];
        $yearAndMonth = DB::select("
            select cast(created_at as date) date, 
            count(case when feedback_number = 1 then 1 end) good, 
            count(case when feedback_number = 2 then 1 end) normal, 
            count(case when feedback_number = 3 then 1 end) bad 
            from notialerts 
            where month(created_at) = $month AND year(created_at) = $year
            group by cast(created_at as date);
        ");

        return response()->json($yearAndMonth);
    }

    public function yearSearch(Request $request){

        $yearlySearch = DB::select("select year(created_at) date, 
        count(case when feedback_number = 1 then 1 end) good, 
        count(case when feedback_number = 2 then 1 end) normal, 
        count(case when feedback_number = 3 then 1 end) bad
        from notialerts 
        where year (created_at) = $request->yearlySearchVal
        group by year(created_at)");
        return response()->json($yearlySearch);

    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'feed_back.xlsx');
    }

}
