<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('contact_number')->nullable()->after('registration_type');
            $table->string('student_id')->nullable()->after('contact_number');
            $table->string('course')->nullable()->after('student_id');
            $table->string('year_graduated')->nullable()->after('course');
            $table->string('organization')->nullable()->after('year_graduated');
            $table->string('address')->nullable()->after('organization');
            $table->string('purpose')->nullable()->after('address');
            $table->string('relationship_to_student')->nullable()->after('purpose');
            $table->string('student_full_name')->nullable()->after('relationship_to_student');
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