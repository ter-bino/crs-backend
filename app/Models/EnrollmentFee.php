<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentFee extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'enrollment_fee';
    protected $primaryKey = 'enrollment_fee_id';


    protected $fillable = [
        'enrollment_fee_type',
        'enrollment_fee_name',
        'cost'
    ];

    protected $casts = [
        'cost' => 'decimal:12,4'
    ];

}
