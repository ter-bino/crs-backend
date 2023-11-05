<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'payment_transaction';
    protected $primaryKey = 'payment_transaction_id';
    
    protected $fillable = [
        'student_balance_id',
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

    protected $casts = [
        'excess_amount' => 'decimal:2',  
        'amount' => 'decimal:2',        
        'time' => 'datetime',
        'date' => 'date',   
    ];
}
