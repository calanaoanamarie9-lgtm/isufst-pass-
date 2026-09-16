<?php

namespace Database\Seeders;

use App\Enums\Office;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CbmsdDepartmentSeeder extends Seeder
{
    public function run(): void
    {
        if (!Office::CBMSD->label()) {
            $this->command->warn('CBMSD case not found in Office enum — skipping.');
            return;
        }

        $user = User::firstOrNew(['email' => 'cbmsd@isufst.edu.ph']);
        $user->fill([
            'name'             => 'CBMSD Department',
            'password'         => Hash::make('password123'),
            'role'             => 'department',
            'office'           => 'CBMSD',
            'email_verified_at'=> now(),
        ]);
        $user->save();

        $this->command->info("CBMSD department account ready — cbmsd@isufst.edu.ph / password123");
    }
}