<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LibraryOfficeSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrNew(['email' => 'library@isufst.edu.ph']);
        $user->fill([
            'name'              => 'University Library',
            'password'          => Hash::make('password123'),
            'role'              => 'library',
            'office'            => 'Library',
            'email_verified_at' => now(),
        ]);
        $user->save();

        $this->command->info("Library office account ready - library@isufst.edu.ph / password123");
    }
}