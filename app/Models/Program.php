<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Program extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'program'; // connected table name
    protected $primaryKey = 'program_id'; //connected table name primary key

    protected $fillable = [
        'program_code',
        'program_name',
        'program_type',
        'active_status',
        'num_years'
    ];

    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class, 'college_id','college_id');
    }
}
