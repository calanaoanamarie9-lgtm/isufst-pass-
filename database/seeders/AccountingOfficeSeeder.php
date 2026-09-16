<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountingOfficeSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrNew(['email' => 'accounting@isufst.edu.ph']);
        $user->fill([
            'name'              => 'Accounting Office',
            'password'          => Hash::make('password123'),
            'role'              => 'accounting',
            'office'            => 'Accounting',
            'email_verified_at' => now(),
        ]);
        $user->save();

        $this->command->info("Accounting office account ready - accounting@isufst.edu.ph / password123");
    }
}