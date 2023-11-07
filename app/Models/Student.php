<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table = 'student'; // connected table name
    protected $primaryKey = 'student_id'; //connected table name primary key

    protected $fillable = [
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

    public function user_account(): BelongsTo
    {
        return $this->belongsTo(UserAccount::class, 'user_account_id', 'user_account_id');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id', 'address_id');
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'student_id', 'student_id');
    }

    public function add_drop_requests(): HasMany
    {
        return $this->hasMany(AddDropRequest::class, 'student_id', 'student_id');
    }

    public function student_terms(): HasMany
    {
        return $this->hasMany(StudentTerm::class, 'student_id', 'student_id');
    }

    public function student_balances(): HasMany
    {
        return $this->hasMany(StudentBalance::class, 'student_id', 'student_id');
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(M_class::class, 'class_student_assignment', 'student_id', 'class_id');
    }

    public function blocks(): BelongsToMany
    {
        return $this->belongsToMany(Block::class, 'block_student_assignment', 'student_id', 'block_id');
    }
}
