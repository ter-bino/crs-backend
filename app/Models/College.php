<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class College extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'college';
    protected $primaryKey = 'college_id';


    protected $fillable = [
        'college_code',
        'college_title',
        'num_terms',
        'active_status',
    ];

    protected $casts = [
        'active_status' => 'boolean',
    ];

    public function student_term(): HasMany
    {
        return $this->hasMany(StudentTerm::class, 'college_id', 'college_id');
    }

    public function program(): HasMany
    {
        return $this->hasMany(Program::class, 'college_id', 'college_id');
    }

}
