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

            $table->string('purpose_type')->nullable()->after('status');
            $table->text('transfer_to')->nullable()->after('purpose_type');
            $table->string('educational_status')->nullable()->after('transfer_to');
            $table->string('educational_level')->nullable()->after('educational_status');
            $table->string('claim_mode')->nullable()->after('educational_level');
            $table->string('representative_name')->nullable()->after('claim_mode');
            $table->string('others_specification')->nullable()->after('representative_name');

            $table->string('student_name')->nullable()->after('user_id');
            $table->text('student_address')->nullable()->after('student_name');
            $table->string('student_contact')->nullable()->after('student_address');
            $table->string('student_course_year')->nullable()->after('student_contact');
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