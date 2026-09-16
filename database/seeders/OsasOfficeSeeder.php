<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class OsasOfficeSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrNew(['email' => 'osas@isufst.edu.ph']);
        $user->fill([
            'name'              => 'Office of Student Affairs & Services',
            'password'          => \Illuminate\Support\Facades\Hash::make('password123'),
            'role'              => 'osas',
            'office'            => 'OSAS',
            'email_verified_at' => now(),
        ]);
        $user->save();

        if ($this->command) {
            $this->command->info("OSAS office account ready - osas@isufst.edu.ph / password123");
        }
    }
}
