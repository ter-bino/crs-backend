<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Program extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'program'; // connected table name
    protected $primaryKey = 'program_id'; //connected table name primary key

    protected $fillable = [
        'program_code',
        'program_name',
        'program_type',
        'active_status',
        'num_years'
    ];

    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class, 'college_id','college_id');
    }

    public function department(): HasOne
    {
        return $this->hasOne(Department::class, 'program_id', 'program_id');
    }

    public function student_terms(): HasMany
    {
        return $this->hasMany(StudentTerm::class, 'program_id', 'program_id');
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class, 'program_id', 'program_id');
    }
}
