<?php

namespace Database\Seeders;

use App\Enums\Office;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CoagDepartmentSeeder extends Seeder
{
    public function run(): void
    {
        if (!Office::Coag->label()) {
            $this->command->warn('COAG case not found in Office enum — skipping.');
            return;
        }

        $user = User::firstOrNew(['email' => 'coag@isufst.edu.ph']);
        $user->fill([
            'name'             => 'COAG Department',
            'password'         => Hash::make('password123'),
            'role'             => 'department',
            'office'           => 'COAG',
            'email_verified_at'=> now(),
        ]);
        $user->save();

        $this->command->info("COAG department account ready — coag@isufst.edu.ph / password123");
    }
}