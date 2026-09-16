<?php

namespace Database\Seeders;

use App\Enums\Office;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CiciDepartmentSeeder extends Seeder
{
    public function run(): void
    {
        if (!Office::Cici->label()) {
            $this->command->warn('CICI case not found in Office enum — skipping.');
            return;
        }

        $user = User::firstOrNew(['email' => 'cici@isufst.edu.ph']);
        $user->fill([
            'name'             => 'CICI Department',
            'password'         => Hash::make('password123'),
            'role'             => 'department',
            'office'           => 'CICI',
            'email_verified_at'=> now(),
        ]);
        $user->save();

        $this->command->info("CICI department account ready — cici@isufst.edu.ph / password123");
    }
}
