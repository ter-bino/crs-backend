<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'activity'; // connected table name
    protected $primaryKey = 'activity_id'; //connected table name primary key

    protected $fillable = [
        'academic_year',
        'term',
        'start_date',
        'end_date'
    ];
}
