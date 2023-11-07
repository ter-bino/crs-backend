<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'room'; // connected table name
    protected $primaryKey = 'room_id'; //connected table name primary key

    protected $fillable = [
        'room_name'
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id', 'building_id');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'room_id', 'room_id');
    }
}
