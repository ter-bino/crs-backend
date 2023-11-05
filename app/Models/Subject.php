<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public $timestamps = true; // automatically create created_at and updated_at timestamps for each model
    protected $table = 'subject'; // declares the associated table
    protected $primaryKey = 'subject_id'; // declares the column name to be used for id

    protected $fillable = [
        'subject_code',
        'subject_title',
        'subject_type',
        'units',
        'credited_units',
        'active_status'
    ];

    protected $casts = [
        'active_status' => 'boolean',
    ];
}
