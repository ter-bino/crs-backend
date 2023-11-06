<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'instructor'; // connected table name
    protected $primaryKey = 'instructor_id'; //connected table name primary key

    protected $fillable = [
        'instructor_code',
        'teaching_position',
        'employment_type'
    ];

}
