<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Role;
use App\Models\Staff;
use App\Models\UserAccount;
use Illuminate\Database\Seeder;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $adminRole = Role::create([
            'role_name' => 'ADMIN',
        ]);

        $userAccount = UserAccount::create([
            'plm_email_address' => env('ADMIN_EMAIL_ADDRESS'),
            'user_password' => bcrypt(env('ADMIN_PASSWORD')),
            'account_expiry_date' => '3999-12-31',
            'active_status' => true,
        ]);

        $userAccount->roles()->attach($adminRole);

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
            'employee_number' => '00000000',
            'designation' => 'Generated Admin Account',
            'first_name' => 'Admin',
            'last_name' => 'Account',
            'middle_name' => 'Generated',
            'name_extension' => '',
            'pedigree' => '',
            'sex' => 'M',
            'civil_status' => 'Single',
            'citizenship' => 'Filipino',
            'birth_date' => '1999-12-31',
            'birth_place' => 'Admin Birth Place',
            'contact_no' => '1234567890',
            'personal_email' => 'icto@plm.edu.ph',
            'TIN_no' => '1234567890',
            'GSIS_no' => '1234567890',
        ]);

        $staff->address()->associate($address);
        $staff->user_account()->associate($userAccount);

        $adminRole->save();
        $userAccount->save();
        $address->save();
        $staff->save();
    }
}
