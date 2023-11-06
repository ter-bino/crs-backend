<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
