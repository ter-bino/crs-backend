<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'schedule'; // connected table name
    protected $primaryKey = 'schedule_id'; //connected table name primary key

    protected $fillable = [
        'day',
        'start_time',
        'end_time'
    ];

    public function meeting_type(): BelongsTo
    {
        return $this->belongsTo(MeetingType::class, 'meeting_type_id', 'meeting_type_id');
    }
}
