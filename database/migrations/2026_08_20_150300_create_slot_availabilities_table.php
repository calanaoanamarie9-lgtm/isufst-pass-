<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Slot availability & capacity management:
     * per-office, per-date, per-time-slot capacity rules and manual blocks.
     */
    public function up(): void
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->unsignedInteger('default_slot_capacity')->default(15);
        });

        Schema::create('slot_availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_id')->constrained()->cascadeOnDelete();
            $table->date('date')->nullable()->comment('Null = default rule for all dates');
            $table->string('time_slot', 30);
            $table->unsignedInteger('max_capacity')->default(15);
            $table->unsignedInteger('booked_slots')->default(0);
            $table->string('status', 20)->default('available')->comment('available | fully_booked | blocked');
            $table->timestamps();

            $table->unique(['office_id', 'date', 'time_slot']);
        });

        DB::table('offices')->insertOrIgnore([
            ['name' => 'OSAS', 'location' => 'Student Center, 2nd Floor', 'contact' => null, 'hours' => 'Mon - Fri, 8:00 AM - 5:00 PM', 'description' => 'Student services, activities, and welfare concerns.', 'default_slot_capacity' => 8, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Registrar', 'location' => 'Main Building, Ground Floor', 'contact' => null, 'hours' => 'Mon - Fri, 8:00 AM - 5:00 PM', 'description' => 'Student records, grades, transcripts, and document issuance.', 'default_slot_capacity' => 6, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Guidance', 'location' => 'Main Building, 2nd Floor', 'contact' => null, 'hours' => 'Mon - Fri, 8:00 AM - 5:00 PM', 'description' => 'Counseling services, testing, and student development.', 'default_slot_capacity' => 8, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cashier', 'location' => 'Finance Building, Ground Floor', 'contact' => null, 'hours' => 'Mon - Fri, 8:00 AM - 5:00 PM', 'description' => 'Financial transactions and official receipts for fees.', 'default_slot_capacity' => 8, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Accounting', 'location' => 'Finance Building, 2nd Floor', 'contact' => null, 'hours' => 'Mon - Fri, 8:00 AM - 5:00 PM', 'description' => 'Billing, accounts, and fund-related concerns.', 'default_slot_capacity' => 6, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Admin', 'location' => 'Main Building, 3rd Floor', 'contact' => null, 'hours' => 'Mon - Fri, 8:00 AM - 5:00 PM', 'description' => 'General inquiries and administrative matters.', 'default_slot_capacity' => 4, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('slot_availabilities');

        Schema::table('offices', function (Blueprint $table) {
            $table->dropColumn('default_slot_capacity');
        });
    }
};