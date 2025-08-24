<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('onlion_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_id')->constrained()->onDelete('cascade');
            $table->foreignId('classe_id')->constrained()->onDelete('cascade');
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->text('topic');
            $table->dateTime('start_time');
            $table->integer('duration');
            $table->timestamps();
            $table->string('meeting_id')->unique(); 
            $table->text('join_url');
            $table->text('start_url');
            $table->string('password')->nullable();
            $table->string('host_id')->nullable();
            $table->string('timezone')->default('Africa/Cairo');
            $table->string('status')->default('waiting');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onlion_classes');
    }
};
