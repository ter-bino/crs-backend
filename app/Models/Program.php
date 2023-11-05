<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'program'; // connected table name
    protected $primaryKey = 'program_id'; //connected table name primary key

    protected $fillable = [
        'college_id',
        'program_code',
        'program_name',
        'program_type',
        'active_status',
        'num_years'
    ];

    protected $casts = [
        'active_status' => 'boolean',
        'num_years' => 'integer'
    ];
}
