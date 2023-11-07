<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EnrollmentStatus extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'enrollment_status';
    protected $primaryKey = 'enrollment_status_id';

    protected $fillable = [
        'enrollment_status_name'
    ];

    public function student_term(): HasOne
    {
        return $this->hasOne(StudentTerm::class, 'enrollment_status_id', 'enrollment_status_id');
    }
}
