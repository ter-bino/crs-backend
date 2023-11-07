<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model
{
    use HasFactory;

    public $timestamps = true; // automatically create created_at and updated_at timestamps for each model
    protected $table = 'address'; // declares the associated table
    protected $primaryKey = 'address_id'; // declares the column name to be used for id

    protected $fillable = [
        'street_address',
        'city',
        'province',
        'zip_code',
        'telephone_no'
    ];

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'address_id', 'address_id');
    }
}
