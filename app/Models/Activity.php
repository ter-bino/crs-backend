<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'activity'; // connected table name
    protected $primaryKey = 'activity_id'; //connected table name primary key

    protected $fillable = [
        'academic_year',
        'term',
        'start_date',
        'end_date'
    ];

    public function activity_type(): BelongsTo
    {
        return $this->belongsTo(ActivityType::class, 'activity_type_id', 'activity_type_id');
    }

    public function sub_activities(): HasMany
    {
        return $this->hasMany(SubActivity::class, 'activity_id', 'activity_id');
    }
}
