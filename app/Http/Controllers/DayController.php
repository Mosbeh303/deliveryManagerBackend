<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Day;
use App\Models\Plan;
use App\Models\Assignment;

use Illuminate\Http\Request;
use DB;

class DayController extends Controller
{
    public function index()
    {
        $now = Carbon::now() ;
        $date = Carbon::parse($now);
        $startOfWeek = $date->startOfWeek()->toDateString();
        $plan = Plan::where('start',$startOfWeek)->first();
        $days = Day::where('plan_id',$plan->id)->get();
        return $days;

    }

    public function getDay(Request $request)
    {
        

        $days=DB::table('assignments')
        ->join ('days','days.id','=','assignments.day_id')
        ->whereIn('assignments.employe_id',$request->ids)
        ->select('days.*')
        ->get();
         return $days;
    }

    public function store(Request $request)
    {
       
        $timestamp = strtotime($request->date);
        $day = new Day([
          
            'date' =>$request->date,
            'label' =>date('l', $timestamp),
        ]);

        $day->save();
        return Day::all();
       
    }

    public function show( $id)
    {
        $day = Day::findOrFail($id);
        return $day;
    }



   
  

    /*public function update(Request $request)
    {
        $plan = Plan::findOrFail($request->id);

        $timestamp = strtotime($request->date);

        $plan->update([
            'date' =>$request->date,
            'day' =>date('l', $timestamp),
        ]);
      return Plan::all();
    }

    public function destroy( $id)
    {
        $plan = Plan::findOrFail($id);

        $plan->delete();
       
      
    }*/
}
