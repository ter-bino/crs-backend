<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = array(
            'ADMIN',
            'COLLEGE_ADMIN',
            'DEPARTMENT_ADMIN',
            'PROGRAM_ADMIN',
            'STUDENT',
        );

        foreach($roles as $role) {
            Role::where('role_name', $role)->firstOrCreate([
                'role_name' => $role,
            ]);
        }
    }
}
