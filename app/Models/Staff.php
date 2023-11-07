<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'staff'; // connected table name
    protected $primaryKey = 'staff_id'; //connected table name primary key

    protected $fillable = [
        'employee_number',
        'designation',
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
        'personal_email',
        'TIN_no',
        'GSIS_no'
    ];
    
    public function user_account()
    {
        return $this->belongsTo(UserAccount::class, 'user_account_id', 'user_account_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'address_id');
    }
}
