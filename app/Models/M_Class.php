<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class M_Class extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'class';
    protected $primaryKey = 'class_id';

    protected $fillable = [
        'academic_year',
        'term',
        'minimum_year_level',
        'section',
        'slots',
        'start_date',
        'end_date',
        'active_status'
    ];

    public function instruction_language(): BelongsTo
    {
        return $this->belongsTo(InstructionLanguage::class, 'instruction_language_id', 'instruction_language_id');
    }
}
