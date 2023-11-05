<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    public $timestamps = true; // automatically create created_at and updated_at timestamps for each model
    protected $table = 'building'; // declares the associated table
    protected $primaryKey = 'building_id'; // declares the column name to be used for id

    protected $fillable = [
        'building_name',
        'building_code'
    ];
}
