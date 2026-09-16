<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->morphs('feedbackable'); // appointment | document_request
            $table->string('service_area')->nullable(); // office / document serviced
            $table->unsignedTinyInteger('rating'); // 1 - 5
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'feedbackable_type', 'feedbackable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};