<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingAssignment extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'teaching_assignment'; // connected table name
    protected $primaryKey = ['instructor_id', 'academic_year', 'term']; //connected table name primary key

    protected $fillable = [
        'academic_year',
        'term',
        'start_date',
    ];
}
