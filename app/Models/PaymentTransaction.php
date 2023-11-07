<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentTransaction extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'payment_transaction';
    protected $primaryKey = 'payment_transaction_id';
    
    protected $fillable = [
        'payment_order',
        'payment_method',
        'payment_status',
        'amount',
        'excess_amount',
        'or_number',
        'code',
        'remark',
        'time',
        'date'
    ];

    public function student_balance(): BelongsTo
    {
        return $this->belongsTo(StudentBalance::class, 'student_balance_id', 'student_balance_id');
    }
}
