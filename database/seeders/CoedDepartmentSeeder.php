<?php

namespace Database\Seeders;

use App\Enums\Office;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CoedDepartmentSeeder extends Seeder
{
    public function run(): void
    {
        if (!Office::Coed->label()) {
            $this->command->warn('COED case not found in Office enum — skipping.');
            return;
        }

        $user = User::firstOrNew(['email' => 'coed@isufst.edu.ph']);
        $user->fill([
            'name'             => 'COED Department',
            'password'         => Hash::make('password123'),
            'role'             => 'department',
            'office'           => 'COED',
            'email_verified_at'=> now(),
        ]);
        $user->save();

        $this->command->info("COED department account ready — coed@isufst.edu.ph / password123");
    }
}