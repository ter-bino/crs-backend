<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'user_account_id', 'user_account_id');
    }

    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class, 'user_account_id', 'user_account_id');
    }

    public function tokens(): HasMany
    {
        return $this->hasMany(UserToken::class, 'user_account_id', 'user_account_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_account_id', 'role_id');
    }
}
