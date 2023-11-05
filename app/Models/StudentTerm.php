<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTerm extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'student_term'; // connected table name
    protected $primaryKey = ['student_id', 'program_id', 'academic_year', 'term']; //connected table name primary key

    protected $fillable = [
        'student_id',
        'program_id',
        'academic_year',
        'term',
        'college_id',
        'block_id',
        'enrollment_status_id',
        'year_level',
        'student_type',
        'registration_code',
        'scholastic_status',
        'is_graduating'
    ];

    protected $casts = [
        'is_graduating' => 'boolean'
    ];
}
