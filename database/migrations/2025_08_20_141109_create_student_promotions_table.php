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
        Schema::create('student_promotions', function (Blueprint $table) {
            $table->id();

            // الطالب
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');

            // من مرحلة (قديمة) -> إلى مرحلة (جديدة)
            $table->foreignId('from_grade')->constrained('grades')->onDelete('cascade');
            $table->foreignId('to_grade')->constrained('grades')->onDelete('cascade');

            // من صف (قديمة) -> إلى صف (جديدة)
            $table->foreignId('from_classroom')->constrained('classes')->onDelete('cascade');
            $table->foreignId('to_classroom')->constrained('classes')->onDelete('cascade');

            // من فصل (قديم) -> إلى فصل (جديد)
            $table->foreignId('from_section')->constrained('sections')->onDelete('cascade');
            $table->foreignId('to_section')->constrained('sections')->onDelete('cascade');

            // السنة الدراسية
            $table->string('from_academic_year');
            $table->string('to_academic_year');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_promotions');
    }
};
