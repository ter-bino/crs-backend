<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StudentTerm extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'student_term'; // connected table name
    protected $primaryKey = ['student_id', 'program_id', 'academic_year', 'term']; //connected table name primary key

    protected $fillable = [
        'academic_year',
        'term',
        'year_level',
        'student_type',
        'registration_code',
        'scholastic_status',
        'is_graduating'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id'. 'student_id');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class, 'college_id','college_id');
    }

    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class, 'block_id', 'block_id');
    }

    public function enrollment_status(): HasOne
    {
        return $this->hasOne(EnrollmentStatus::class, 'enrollment_status_id', 'enrollment_status_id');
    }
}
