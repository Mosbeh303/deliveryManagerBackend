<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'employe_id','round_id','day_id','plan_id'
    ]; 
  


    use HasFactory;
}
