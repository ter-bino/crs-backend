<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSession extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'user_session';
    protected $primaryKey = 'user_session_id';

    protected $fillable = [
        'user_account_id',
        'user_session_token',
        'last_used'
    ];

    public function userAccount(): BelongsTo
    {
        return $this->belongsTo(UserAccount::class, 'user_account_id', 'user_account_id');
    }
}
