<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'student'; // connected table name
    protected $primaryKey = 'student_id'; //connected table name primary key

    protected $fillable = [
        'user_account_id',
        'address_id',
        'student_no',
        'entry_academic_year',
        'first_name',
        'last_name',
        'middle_name',
        'name_extension',
        'pedigree',
        'sex',
        'civil_status',
        'citizenship',
        'birth_date',
        'birth_place',
        'contact_no',
        'personal_email'
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];
}
