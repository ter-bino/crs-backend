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
        'room_name'
    ];
}
