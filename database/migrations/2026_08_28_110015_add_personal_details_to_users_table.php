<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('contact_number')->nullable();
            $table->string('student_id')->nullable();
            $table->string('course')->nullable();
            $table->string('year_graduated')->nullable();
            $table->string('organization')->nullable();
            $table->string('address')->nullable();
            $table->string('purpose')->nullable();
            $table->string('relationship_to_student')->nullable();
            $table->string('student_full_name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'contact_number',
                'student_id',
                'course',
                'year_graduated',
                'organization',
                'address',
                'purpose',
                'relationship_to_student',
                'student_full_name',
            ]);
        });
    }
};