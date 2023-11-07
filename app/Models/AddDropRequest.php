<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AddDropRequest extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'add_drop_request'; // connected table name
    protected $primaryKey = 'add_drop_request_id'; //connected table name primary key

    protected $fillable = [
        'request_date',
        'total_units',
        'reason',
        'status',
        'approved_date'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
