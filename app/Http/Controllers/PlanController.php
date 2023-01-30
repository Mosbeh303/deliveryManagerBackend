<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Plan;
use App\Models\Day;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return Plan::all();
      
    }
    

    
    public function verifyPlan()
    { 
        $now = Carbon::now() ;
        $date = Carbon::parse($now);
        $startOfWeek = $date->startOfWeek()->toDateString();
        $count = Plan::where('start',$startOfWeek)->count();
    return $count;
    }







    public function store()
    {  $now = Carbon::now() ;
        $date = Carbon::parse($now);
        $startOfWeek = $date->startOfWeek()->toDateString();
        $endOfWeek = $date->endOfWeek()->toDateString();
        $weekOfYear = $date-> weekOfYear;
        $existedPlan = Plan::whereBetween('start', [$startOfWeek, $endOfWeek])->first();
       
           
    
        $count = Plan::where('start',$startOfWeek)->count();
        
        if (  $count ===0) {
               
        
        $plan = new Plan([
          
            'start' =>  $startOfWeek ,
            'end' => $endOfWeek,
            'weekOfYear'=> $weekOfYear ,
        ]);

        $plan->save();
       
      for ($i=0; $i < 7; $i++) { 
       
        $date->addDays(1)->format("Y-m-d");
        $DayLabel = strtotime($date);
        $day = new Day([
       
         'label' => date('l', $DayLabel) ,
         'date' => $date ,
         'plan_id' =>  $plan->id,
     ]);

     $day->save();

    
     
       
        }
        }
        
        return Plan::all();
    }

    public function show( $id)
    {
        $plan = Plan::findOrFail($id);
        return $plan;
    }



    public function edit(Plan $plan)
    {
        return view('plans.edit',compact('plan'));
    }
  

    public function update(Request $request)
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
       
      
    }
}
