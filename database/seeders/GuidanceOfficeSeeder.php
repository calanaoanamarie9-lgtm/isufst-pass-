<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuidanceOfficeSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrNew(['email' => 'guidance@isufst.edu.ph']);
        $user->fill([
            'name'              => 'Guidance & Counseling Office',
            'password'          => Hash::make('password123'),
            'role'              => 'guidance',
            'office'            => 'Guidance',
            'email_verified_at' => now(),
        ]);
        $user->save();

        $this->command->info("Guidance office account ready - guidance@isufst.edu.ph / password123");
    }
}
