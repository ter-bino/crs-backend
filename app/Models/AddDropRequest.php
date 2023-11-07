<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function requestor(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function approved_by(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'approved_by', 'staff_id');
    }

    public function dropped_classes(): BelongsToMany
    {
        return $this->belongsToMany(M_Class::class, 'dropped_classes', 'add_drop_request_id', 'class_id');
    }

    public function added_classes(): BelongsToMany
    {
        return $this->belongsToMany(M_Class::class, 'added_classes', 'add_drop_request_id', 'class_id');
    }
}
