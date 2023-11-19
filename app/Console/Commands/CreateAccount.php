<?php

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\Role;
use App\Models\Staff;
use App\Models\Student;
use App\Models\UserAccount;
use Illuminate\Console\Command;

class CreateAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:create 
                            {email : The email address of the admin} 
                            {--roles= : The role for the admin (default: all)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an account with all roles, or roles specified.';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $email = $this->argument('email');
        $opt_roles = strtoupper($this->option('roles') ?? 'ALL');

        if(UserAccount::where('plm_email_address', $this->argument('email'))->exists()) {
            $this->error("An account with email address $email already exists.");
            return;
        }

        $userAccount = UserAccount::create([
            'plm_email_address' => $email,
            'account_expiry_date' => '3999-12-31',
            'active_status' => true,
        ]);

        $this->info("Created an account for $email with account id $userAccount->user_account_id");

        $address = Address::create([
            'street_address' => '1234 Admin Street',
            'city' => 'Admin City',
            'province' => 'Admin Province',
            'zip_code' => '12345',
            'telephone_no' => '1234567890',
        ]);
        
        $generated_staff = Staff::where('designation', 'Generated Admin Account')->orderBy('employee_number', 'desc')->first();
        
        $staff = Staff::create([
            'user_account_id' => $userAccount->user_account_id,
            'address_id' => $address->address_id,
            'employee_number' => ($generated_staff->employee_number ?? 0) + 1,
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
            'contact_no' => ($generated_staff->contact_no ?? 0) + 1,
            'personal_email' => $email,
            'TIN_no' => ($generated_staff->TIN_no ?? 0) + 1,
            'GSIS_no' => ($generated_staff->GSIS_no ?? 0) + 1,
        ]);
        
        if(!$opt_roles || $opt_roles == 'ALL') {
            $roles = Role::all();
        } else {
            $roles = Role::wherein('role_name', explode(',', $this->option('roles')))->get();
        }

        $role_count = 0;
        foreach($roles as $role) {
            $userAccount->roles()->attach($role->role_id);
            $this->info("-->Added $role->role_name role.");
            $role_count++;
        }

        if ($opt_roles == "ALL" || str_contains($opt_roles, 'STUDENT_UNDERGRADUATE') || str_contains($opt_roles, 'STUDENT_GRADUATE')) {
            $generated_student = Student::where('middle_name', 'GENERATED')->orderBy('student_no', 'desc')->first();;

            $student = Student::create([
                'user_account_id' => $userAccount->user_account_id,
                'address_id' => $address->address_id,
                'student_no' => ($generated_student->student_no ?? 0) + 1,
                'entry_academic_year' => '2099-2039',
                'first_name' => 'ADMIN',
                'last_name' => 'STUDENT',
                'middle_name' => 'GENERATED',
                'name_extension' => '',
                'pedigree' => '',
                'sex' => 'M',
                'civil_status' => 'Single',
                'citizenship' => 'Filipino',
                'birth_date' => '1999-12-31',
                'birth_place' => 'Manila',
                'contact_no' => ($generated_student->contact_no ?? 0) + 1,
                'personal_email' => $email,
            ]);
            $student->address()->associate($address);
            $student->user_account()->associate($userAccount);
            $student->save();
        }
        $staff->address()->associate($address);
        $staff->user_account()->associate($userAccount);
        $userAccount->save();
        $address->save();
        $staff->save();

        $this->info('Account creation is complete with '.$role_count.' roles.');
    }
}
