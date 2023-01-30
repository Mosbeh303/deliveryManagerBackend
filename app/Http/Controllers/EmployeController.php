<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Day;
use DB;
use Carbon\Carbon;
use App\Models\plan;
class EmployeController extends Controller
{
    public function index()
    {
       
        $days = Day::all();
        $now = Carbon::now() ;
        $date = Carbon::parse($now);
foreach ($days as $key => $day) {
    if ($day->date < $date) {
        $employes=DB::table('assignments')
        ->join ('employes','employes.id','=','assignments.employe_id')
        ->where(['assignments.day_id'=> $day->id])
        ->select('employes.*')
        ->update(['available' => TRUE]);
        

    }
}

$employes = Employe::all();
        return $employes;
      
       
    }
    public function planEmployes(Request $request)
    {
      
     // $assignments = Assignment::where('plan_id', $request->planId)->get();

     $employes=DB::table('assignments')
     ->join ('employes','employes.id','=','assignments.employe_id')
     ->where(['assignments.plan_id'=> $request->planId])
     ->select('employes.*')
     ->get();
      return $employes;

    }




    public function create()
    {
        return view('employes.create');
    }

    public function store(Request $request)
    {


      
        $employe = new Employe([
           
            'name' =>$request->name, 
            'tel' =>$request->tel,
            'available' =>true,

        ]);

        $employe->save();
       
       
       
       return Employe::all();
     
       
    }

    public function show($id)
    {
        $employe = Employe::findOrFail($id);

     return  $employe->available ;

        
    }



    public function edit(Employe $employe)
    {
        return view('employes.edit',compact('employe'));
    }
    

    public function setToBusy(Request $request)
    {
        $employe = Employe::findOrFail($request->idEmploye);
        

        $employe->update([
            'available' =>false,
           

        
        ]);
      
     return Employe::all();
    }






    public function update(Request $request)
    {
        $employe = Employe::findOrFail($request->id);
        

        $employe->update([
            'name' =>$request->name,
            'tel' =>$request->tel,

        
        ]);
      
     return Employe::all();
    }








    public function destroy( $id)
    { 
               $employe = Employe::findOrFail($id);

        $employe->delete();
       
        
    }
}
