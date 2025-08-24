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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // عشان ندعم عربي وإنجليزي
            $table->string('national_id', 20)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birth_date');
            $table->unsignedBigInteger('religion_id');
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('classroom_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('parent_id');
            $table->text('address');
            $table->timestamps();

            // العلاقات
            $table->foreign('religion_id')->references('id')->on('religions')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('classroom_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('my_parents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
