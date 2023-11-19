<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Role;
use App\Models\Staff;
use App\Models\Student;
use App\Models\UserAccount;
use Illuminate\Database\Seeder;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $adminEmails = explode(',', env('ADMIN_EMAIL_ADDRESSES'));
        $userAccounts = [];
        
        foreach($adminEmails as $email) {
            $userAccounts[] = UserAccount::create([
                'plm_email_address' => $email,
                'account_expiry_date' => '3999-12-31',
                'active_status' => true,
            ]);
        }

        foreach($userAccounts as $i=>$userAccount) {
        
            $address = Address::create([
                'street_address' => '1234 Admin Street',
                'city' => 'Admin City',
                'province' => 'Admin Province',
                'zip_code' => '12345',
                'telephone_no' => '1234567890',
            ]);

            $staff = Staff::create([
                'user_account_id' => $userAccount->user_account_id,
                'address_id' => $address->address_id,
                'employee_number' => "0000000$i",
                'designation' => 'Generated Admin Account',
                'first_name' => 'ADMIN',
                'last_name' => 'STAFF',
                'middle_name' => 'GENERATED',
                'name_extension' => '',
                'pedigree' => '',
                'sex' => 'M',
                'civil_status' => 'Single',
                'citizenship' => 'Filipino',
                'birth_date' => '1999-12-31',
                'birth_place' => 'Admin Birth Place',
                'contact_no' => "123456789$i",
                'personal_email' => "icto$i@plm.edu.ph",
                'TIN_no' => "123456789$i",
                'GSIS_no' => "123456789$i",
            ]);

            foreach(Role::all() as $role) {
                $userAccount->roles()->attach($role->role_id);
            }

            $student = Student::create([
                'user_account_id' => $userAccount->user_account_id,
                'address_id' => $address->address_id,
                'student_no' => "0000000$i",
                'entry_academic_year' => '2099-2039',
                'first_name' => 'Admin',
                'last_name' => 'STUDENT',
                'middle_name' => 'GENERATED',
                'name_extension' => '',
                'pedigree' => '',
                'sex' => 'M',
                'civil_status' => 'Single',
                'citizenship' => 'Filipino',
                'birth_date' => '1999-12-31',
                'birth_place' => 'Manila',
                'contact_no' => "123456789$i",
                'personal_email' => "icto$i@plm.edu.ph",
            ]);

            $staff->address()->associate($address);
            $staff->user_account()->associate($userAccount);
            $student->address()->associate($address);
            $student->user_account()->associate($userAccount);
            $userAccount->save();
            $address->save();
            $staff->save();
            $student->save();
        }
    }
}
