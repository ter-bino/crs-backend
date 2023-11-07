<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'department'; // connected table name
    protected $primaryKey = 'department_id'; //connected table name primary key

    protected $fillable = [
        'department_code',
        'department_name'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }
}
