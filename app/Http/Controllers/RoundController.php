<?php

namespace App\Http\Controllers;
use App\Models\Round;
use App\Models\Plan;
use App\Models\Employe;
use App\Models\Day;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Assignment;
class RoundController extends Controller
{
    public function index()
    {
        return Round::all();
      
    }
    
      
    public function getRoundsNumber()
    {

        $now = Carbon::now() ;
        $date = Carbon::parse($now);
        $weekOfYear = $date-> weekOfYear;
        $plan = Plan::where('weekOfYear',$weekOfYear )->first();
             

        $rounds=DB::table('assignments')
        ->join ('rounds','rounds.id','=','assignments.round_id')
        ->where(['assignments.plan_id'=>  $plan->id])
        ->select('rounds.*');
        return  $rounds->count();
    
 
    
    }





    public function planRounds(Request $request)
    {
      
     // $assignments = Assignment::where('plan_id', $request->planId)->get();

     $rounds=DB::table('assignments')
     ->join ('rounds','rounds.id','=','assignments.round_id')
     ->where(['assignments.plan_id'=> $request->planId])
     ->select('rounds.*')
     ->get();
      return $rounds;

    }


 public function create(Employe $employe)
    {      
        return view('rounds.create',compact('employe'));
    }


    


    public function dailyRounds(Request $request)
    {
        

        $rounds=DB::table('assignments')
     ->join ('rounds','rounds.id','=','assignments.round_id')
     ->where(['assignments.day_id'=> $request->day_id])
     ->where(['rounds.zip_code'=> $request->zip_code])
     ->select('rounds.*')
     ->get();
      return $rounds->count();
        
      
        
     }


    public function store(Request $request)
    { 
    
        $round = new Round([
          
            'destination' =>$request->destination,  
            'zip_code' =>$request->zip_code, 
            'employe_id'=>$request->id,

        ]);

        $round->save();
       
         return $round->id;
    }

    public function show(Round $round)
    {
        return view('rounds.show',compact('round'));
    }



    public function edit(Round $round)
    {
        return view('rounds.edit',compact('round'));
    }
  

    public function update(Request $request)
    {
      
        $round = Round::findOrFail($request->id);


        $round->update([
            'destination' =>$request->destination,
            'zip_code' =>$request->zip_code,

        ]);
      
        return Round::all();
    }

    public function destroy( $id)
    {
        $round = Round::findOrFail($id);
        $round->delete();
       
    }
}
