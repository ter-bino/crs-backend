<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Department extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'department'; // connected table name
    protected $primaryKey = 'department_id'; //connected table name primary key

    protected $fillable = [
        'department_code',
        'department_name'
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function instructors(): BelongsToMany
    {
        return $this->belongsToMany(Instructor::class, 'instructor_department_assignment', 'department_id', 'instructor_id');
    }
}
