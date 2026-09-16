<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Admin module tables: offices, settings, audit logs, and user activity flag.
     */
    public function up(): void
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('location')->nullable();
            $table->string('contact')->nullable();
            $table->string('hours')->nullable();
            $table->string('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('actor_name')->nullable();
            $table->string('role')->nullable();
            $table->string('action');
            $table->string('description');
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();

            $table->index(['action', 'created_at']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);
        });

        DB::table('settings')->insert([
            ['key' => 'institution_name', 'value' => 'Iloilo State University of Fisheries Science and Technology'],
            ['key' => 'institution_address', 'value' => 'Tiwi, Barotac Nuevo, Iloilo'],
            ['key' => 'academic_term', 'value' => '1st Semester, AY 2026-2027'],
            ['key' => 'support_email', 'value' => 'registrardingle@isufst.edu.ph'],
            ['key' => 'support_phone', 'value' => '(033) 555-1234'],
            ['key' => 'banner_enabled', 'value' => 'false'],
            ['key' => 'banner_text', 'value' => ''],
        ]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('offices');
    }
};