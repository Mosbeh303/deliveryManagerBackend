<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Plan;
use Carbon\Carbon;


class AssignementController extends Controller
{
    public function index(Request $request)
    {


       $assignments = Assignment::where('day_id', $request->dayId)->get();
        return $assignments;
      
       
    }
   

    public function store(Request $request)
    {
        $now = Carbon::now() ;
        $date = Carbon::parse($now);
        $startOfWeek = $date->startOfWeek()->toDateString();   
        $currentPlan = Plan::where('start',$startOfWeek)->first();


        $assignement = new Assignment([
           
            'employe_id' =>$request->employe_id, 
            'round_id' =>$request->round_id,
            'day_id' =>$request->day_id,
            'plan_id' => $currentPlan->id,
        ]);

        $assignement->save();
       
        return Assignment::all();
    }

    public function show( $id)
    {
        $assignement = Assignment::findOrFail($id);
        return $assignment;
    }



  
  

  







    public function destroy( $id)
    { 
               $assignement = Assignement::findOrFail($id);

        $assignement->delete();
       
        
    }

}
