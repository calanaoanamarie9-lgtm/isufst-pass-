<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('reference_code')->nullable()->unique();
            $table->date('original_date')->nullable();
            $table->text('reschedule_reason')->nullable();
            $table->timestamp('rescheduled_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropUnique(['reference_code']);
            $table->dropColumn([
                'reference_code',
                'original_date',
                'reschedule_reason',
                'rescheduled_at',
            ]);
        });
    }
};