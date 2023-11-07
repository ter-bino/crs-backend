<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LoadType extends Model
{
    use HasFactory;

    public $timestamps = true; // automatically create created_at and updated_at timestamps for each model
    protected $table = 'load_type'; // declares the associated table
    protected $primaryKey = 'load_type_id'; // declares the column name to be used for id

    protected $fillable = [
        'load_type_code',
        'load_type_name'
    ];

    public function teaching_assignments(): BelongsToMany
    {
        return $this->belongsToMany(TeachingAssignment::class, 'faculty_class_assignment', 'load_type_id', 'teaching_assignment_id');
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(M_Class::class, 'faculty_class_assignment', 'load_type_id', 'class_id');
    }
}
