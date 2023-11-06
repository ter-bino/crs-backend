<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructionLanguage extends Model
{
    use HasFactory;

    public $timestamps = true; // automatically create created_at and updated_at timestamps for each model
    protected $table = 'instruction_language'; // declares the associated table
    protected $primaryKey = 'instruction_language_id'; // declares the column name to be used for id

    protected $fillable = [
        'language'
    ];
}
