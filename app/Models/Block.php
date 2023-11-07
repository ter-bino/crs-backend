<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Block extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'block'; // connected table name
    protected $primaryKey = 'block_id'; //connected table name primary key

    protected $fillable = [
        'academic_year',
        'term',
        'section',
        'slots'
    ];
    
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'block_student_assignment', 'block_id', 'student_id');
    }
}
