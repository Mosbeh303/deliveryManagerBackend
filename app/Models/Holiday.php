<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{

    protected $fillable = [
       'date', 'employe_id',
    ]; 
  

    use HasFactory;
}
