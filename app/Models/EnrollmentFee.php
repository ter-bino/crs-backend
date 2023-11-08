<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function student_balances(): BelongsToMany
    {
        return $this->belongsToMany(StudentBalance::class, 'fees_to_pay', 'enrollment_fee_id', 'student_balance_id');
    }
}
