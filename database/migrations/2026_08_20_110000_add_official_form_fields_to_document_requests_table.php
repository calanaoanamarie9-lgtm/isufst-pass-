<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('document_requests', function (Blueprint $table) {
            $table->dropForeign(['document_id']);
            $table->dropColumn(['document_id', 'purpose']);

            $table->string('purpose_type')->nullable();
            $table->text('transfer_to')->nullable();
            $table->string('educational_status')->nullable();
            $table->string('educational_level')->nullable();
            $table->string('claim_mode')->nullable();
            $table->string('representative_name')->nullable();
            $table->string('others_specification')->nullable();

            $table->string('student_name')->nullable();
            $table->text('student_address')->nullable();
            $table->string('student_contact')->nullable();
            $table->string('student_course_year')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('document_requests', function (Blueprint $table) {
            $table->foreignId('document_id')->nullable()->constrained()->cascadeOnDelete();
            $table->text('purpose')->nullable();

            $table->dropColumn([
                'purpose_type',
                'transfer_to',
                'educational_status',
                'educational_level',
                'claim_mode',
                'representative_name',
                'others_specification',
                'student_name',
                'student_address',
                'student_contact',
                'student_course_year',
            ]);
        });
    }
};