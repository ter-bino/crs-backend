<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsultationHour extends Model
{
    use HasFactory;

    public $timestamps = true; // automatically create created_at and updated_at timestamps for each model
    protected $table = 'consultation_hour'; // declares the associated table
    protected $primaryKey = 'consultation_hour_id'; // declares the column name to be used for id

    protected $fillable = [
        'day',
        'start_time',
        'end_time',
    ];

    public function teaching_assignment(): BelongsTo
    {
        return $this->belongsTo(TeachingAssignment::class, 'teaching_assignment_id', 'teaching_assignment_id');
    }
}
