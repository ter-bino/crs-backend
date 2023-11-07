<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class M_Class extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'class';
    protected $primaryKey = 'class_id';

    protected $fillable = [
        'academic_year',
        'term',
        'minimum_year_level',
        'section',
        'slots',
        'start_date',
        'end_date',
        'active_status'
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }

    public function instruction_language(): BelongsTo
    {
        return $this->belongsTo(InstructionLanguage::class, 'instruction_language_id', 'instruction_language_id');
    }

    public function teachingAssignments(): BelongsToMany
    {
        return $this->belongsToMany(TeachingAssignment::class, 'faculty_class_assignment', 'class_id', 'teaching_assignment_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'class_student_assignment', 'class_id', 'student_id');
    }

    public function blocks(): BelongsToMany
    {
        return $this->belongsToMany(Block::class, 'block_class_assignment', 'class_id', 'block_id');
    }

    public function class_drops(): BelongsToMany
    {
        return $this->belongsToMany(AddDropRequest::class, 'dropped_classes', 'class_id', 'add_drop_request_id');
    }

    public function class_adds(): BelongsToMany
    {
        return $this->belongsToMany(AddDropRequest::class, 'added_classes', 'class_id', 'add_drop_request_id');
    }
}
