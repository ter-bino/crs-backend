<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
