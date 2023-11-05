<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'room'; // connected table name
    protected $primaryKey = 'room_id'; //connected table name primary key

    protected $fillable = [
        'room_id',
        'meeting_type_id',
        'class_id',
        'day',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];
}
