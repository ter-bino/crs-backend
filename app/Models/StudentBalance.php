<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBalance extends Model
{
    use HasFactory;

    public $timestamps = true; // automatically create created_at and updated_at timestamps for each model
    protected $table = 'student_balance'; // declares the associated table
    protected $primaryKey = 'student_balance_id'; // declares the column name to be used for id

    protected $fillable = [
        'terms_of_payment',
        'assessment_type',
        'academic_year',
        'term',
        'total_amount',
        'paid_amount',
        'overall_paid',
        'overall_balance'
    ];

    protected $casts = [
        'term' => 'integer',
        'total_amount' => 'decimal:12,2',
        'paid_amount' => 'decimal:12,2',
        'overall_paid' => 'decimal:12,2',
        'overall_balance' => 'decimal:12,2'
    ];
    
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
