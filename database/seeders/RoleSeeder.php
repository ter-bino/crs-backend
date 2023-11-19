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
            'FACULTY',
            'COLLEGE',
            'STUDENT_UNDERGRADUATE',
            'STUDENT_GRADUATE',
            'CASHIER',
        );

        foreach($roles as $role) {
            Role::where('role_name', $role)->firstOrCreate([
                'role_name' => $role,
            ]);
        }
    }
}
