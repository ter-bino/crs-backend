<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    use HasFactory;

    public $timestamps = true; // automatically create created_at and updated_at timestamps for each model
    protected $table = 'activity_type'; // declares the associated table
    protected $primaryKey = 'activity_type_id'; // declares the column name to be used for id

    protected $fillable = [
        'activity_type_name'
    ];
}
