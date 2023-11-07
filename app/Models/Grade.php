<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    use HasFactory;
    public $timestamps = true; 

    protected $table = 'class_student_assignment';

    protected $primaryKey = ['student_id', 'class_id'];

    protected $fillable = [
        'grade',
        'remarks'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(M_class::class, 'class_id', 'class_id');
    }
}
