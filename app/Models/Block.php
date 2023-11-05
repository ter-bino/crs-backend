<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'block'; // connected table name
    protected $primaryKey = 'block_id'; //connected table name primary key

    protected $fillable = [
        'program_id',
        'academic_year',
        'term',
        'section',
        'slots'
    ];

    protected $casts = [
        'term' => 'integer',
        'section' => 'integer',
        'slots' => 'integer'
    ];
}
