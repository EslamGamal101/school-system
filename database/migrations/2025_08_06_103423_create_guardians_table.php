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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();

            // Father Info
            $table->string('father_name');
            $table->string('father_national_id');
            $table->string('father_passport')->nullable();
            $table->string('father_phone');
            $table->string('father_job')->nullable();
            $table->unsignedBigInteger('father_nationality_id');
            $table->unsignedBigInteger('father_religion_id');
            $table->string('father_address')->nullable();
            $table->boolean('is_father_alive')->default(true);
            $table->enum('marital_status', ['married', 'divorced', 'widowed'])->default('married');

            // Mother Info
            $table->string('mother_name');
            $table->string('mother_national_id');
            $table->string('mother_passport')->nullable();
            $table->string('mother_phone');
            $table->string('mother_job')->nullable();
            $table->unsignedBigInteger('mother_nationality_id');
            $table->unsignedBigInteger('mother_religion_id');
            $table->string('mother_address')->nullable();
            $table->boolean('is_mother_alive')->default(true);

            // Account Info
            $table->string('email')->unique();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('father_nationality_id')->references('id')->on('nationals')->onDelete('cascade');
            $table->foreign('father_religion_id')->references('id')->on('religions')->onDelete('cascade');
            $table->foreign('mother_nationality_id')->references('id')->on('nationals')->onDelete('cascade');
            $table->foreign('mother_religion_id')->references('id')->on('religions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
