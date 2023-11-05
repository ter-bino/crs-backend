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
        'activity_type_id',
        'academic_year',
        'term',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];
}
