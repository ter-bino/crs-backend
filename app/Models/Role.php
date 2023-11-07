<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    public $timestamps = true; // automatically create created_at and updated_at timestamps for each model
    protected $table = 'role'; // declares the associated table
    protected $primaryKey = 'role_id'; // declares the column name to be used for id

    protected $fillable = [
        'role_name'
    ];

    public function user_accounts(): BelongsToMany
    {
        return $this->belongsToMany(UserAccount::class, 'user_roles', 'role_id', 'user_account_id');
    }
}
