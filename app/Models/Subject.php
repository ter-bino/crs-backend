<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function classes(): HasMany
    {
        return $this->hasMany(M_Class::class, 'subject_id', 'subject_id');
    }

    public function co_requisites(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'co_requisite', 'subject_id', 'co_requisite_subject_id');
    }

    public function pre_requisites(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'pre_requisite', 'subject_id', 'pre_requisite_subject_id');
    }
}
