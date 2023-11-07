<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function staff_info(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'staff_id', 'staff_id');
    }
}
