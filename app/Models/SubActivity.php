<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubActivity extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'sub_activity'; // connected table name
    protected $primaryKey = 'sub_activity_id'; //connected table name primary key

    protected $fillable = [
        'sub_activity_name',
        'start_date',
        'end_date'
    ];
}
