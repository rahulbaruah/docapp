<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Referred;
use Log;

class ReportController extends Controller
{
    public function AppReport(Request $request){
        $carbon = Carbon::now();
        $date = $carbon->toDateString();
        
        $queryToday = Referred::where('referred_user_id',$request->user()->id)
                                ->whereDate('created_at', $date);
        
        //$todayTotalPatients = $queryToday->count();
        
        $todayPatients = $queryToday->whereDate('arrived_at', $date)
                                ->count();
                                
        $commission = $queryToday->sum('commission');
        
        $data = [ 'todayPatients' => $todayPatients, 'todayTotalPatients' => $todayPatients, 'todayTotalCollection' => $commission ];
        
        //Log::info($data);
        
        if($request -> ajax() || $request->is('api/*')){
			return response()->json($data);
		}
    }
    
    public function Last2Report(Request $request){
        $carbon = Carbon::now();
        $date = $carbon->toDateString();
        
        $yesterday = $carbon->subDay()->toDateString();
        
        
        $queryToday = Referred::where('referred_user_id',$request->user()->id)
                                ->whereDate('created_at', '>=', $yesterday);
        
        //$last2daysTotalPatients = $queryToday->count();
        
        $last2daysPatients = $queryToday->whereDate('arrived_at', '!=', 0)
                                ->count();
        
        $commission = $queryToday->sum('commission');
        
        $data = [ 'last2daysPatients' => $last2daysPatients, 'last2daysTotalPatients' => $last2daysPatients, 'last2daysTotalCollection' => $commission ];
        
        if($request -> ajax() || $request->is('api/*')){
			return response()->json($data);
		}
    }
    
    public function filterReport(Request $request){
        $this->validate($request, [
			'start_date' => 'required',
			'end_date' => 'required',
        ],[
            'start_date.required' => 'Start date is reuired',
            'end_date.required' => 'End date is reuired',
        ]);
        
        $start_dt = Carbon::parse($request->input('start_date'));
        $start_date = $start_dt->toDateString();
        
        $end_dt = Carbon::parse($request->input('end_date'));
        $end_date = $end_dt->toDateString();
        
        $query = Referred::where('referred_user_id',$request->user()->id)
                                ->whereDate('created_at', '>=', $start_date)
                                ->whereDate('created_at', '<=', $end_date);
        
        //$totalPatientsReport = $query->count();
        
        $patientsReport = $query->whereDate('arrived_at', '!=', 0)
                                ->count();
                                
        $commission = $query->sum('commission');
        
        $data = [ 'patientsReport' => $patientsReport, 'totalPatientsReport' => $patientsReport, 'totalCollection' => $commission ];
        
        if($request -> ajax() || $request->is('api/*')){
			return response()->json($data);
		}
    }
}
