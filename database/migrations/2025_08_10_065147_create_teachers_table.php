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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('Email')->unique();
            $table->string('Password');
            $table->date('Joining_Date');
            $table->text('Address');
            $table->enum('Gender', ['male', 'female']);
            $table->bigInteger('Specialists_id')->unsigned();
            $table->foreign('Specialists_id')->references('id')->on('specialists')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
