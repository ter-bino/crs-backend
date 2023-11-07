<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MeetingType extends Model
{
    use HasFactory;

    public $timestamps = true; // automatically create created_at and updated_at timestamps for each model
    protected $table = 'meeting_type'; // declares the associated table
    protected $primaryKey = 'meeting_type_id'; // declares the column name to be used for id

    protected $fillable = [
        'meeting_type_code',
        'label',
        'active_status'
    ];

    protected $casts = [
        'active_status' => 'boolean'
    ];

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'meeting_type_id', 'meeting_type_id');
    }
}
