<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementsSeeder extends Seeder
{
    public function run(): void
    {
        $announcements = [
            [
                'title' => 'Semester Enrollment Schedule Announced',
                'office' => 'Registrar',
                'body' => 'Enrollment for the First Semester begins on August 25. Students are advised to settle clearances with the Accounting and Cashier offices before enrolling.',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'QR Pass Now Required for Campus Entry',
                'office' => 'Admin',
                'body' => 'Starting this month, all students must present their ISUFSTPASS QR code at the main gate for entry and exit logging. Make sure your QR pass is active before coming to campus.',
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Guidance Office Offers Free Counseling Sessions',
                'office' => 'Guidance',
                'body' => 'The Guidance Office is now accepting appointments for free counseling sessions. Book your slot through the ISUFSTPASS appointment system.',
                'published_at' => now()->subHours(6),
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::updateOrCreate(
                ['title' => $announcement['title']],
                [...$announcement, 'is_published' => true]
            );
        }
    }
}