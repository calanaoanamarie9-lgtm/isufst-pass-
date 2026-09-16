<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->uuid('qr_token')->nullable()->unique()->after('reference_code');
        });

        DB::table('appointments')
            ->whereNull('qr_token')
            ->orderBy('id')
            ->get()
            ->each(fn ($appointment) => DB::table('appointments')
                ->where('id', $appointment->id)
                ->update(['qr_token' => (string) Str::uuid()]));
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('qr_token');
        });
    }
};
