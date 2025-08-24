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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_id')->constrained()->onDelete('cascade');
            $table->foreignId('classe_id')->constrained()->onDelete('cascade');
            $table->foreignId('section_id')->constrained()->onDelete('cascade');

            // بيانات الفاتورة
            $table->string('academic_year'); // السنة الدراسية
            $table->decimal('amount', 10, 2); // المبلغ (مثال 1500.00)
            $table->string('fee_type')->nullable(); // نوع المصروف (اختياري)
            $table->text('description')->nullable(); // ملاحظات (اختياري)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
