<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable = [
        'label', 'date','plan_id'
    ]; 


    use HasFactory;
}