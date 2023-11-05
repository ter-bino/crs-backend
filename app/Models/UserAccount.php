<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'user_account';
    protected $primaryKey = 'user_account_id';


    protected $fillable = [
        'plm_email_address',
        'user_password',
        'account_expiry_date',
        'active_status'
    ];

    protected $casts = [
        'account_expiry_date' => 'date',
        'active_status' => 'boolean'
    ];
}
