<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentStatus extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'enrollment_status';
    protected $primaryKey = 'enrollment_status_id';


    protected $fillable = [
        'enrollment_status_name'
    ];
}
