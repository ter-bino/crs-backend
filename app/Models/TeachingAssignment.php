<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'instructor_id');
    }

    public function consultation_hours(): HasMany
    {
        return $this->hasMany(ConsultationHour::class, 'teaching_assignment_id', 'teaching_assignment_id');
    }

    public function load_types(): BelongsToMany
    {
        return $this->belongsToMany(LoadType::class, 'faculty_class_assignment', 'teaching_assignment_id', 'load_type_id');
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(M_class::class, 'faculty_class_assignment', 'teaching_assignment_id', 'class_id');
    }
}
