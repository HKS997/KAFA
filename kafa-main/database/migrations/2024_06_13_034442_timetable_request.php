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
        Schema::create('timetable_request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timetableID')->constrained('timetables')->onDelete('cascade');
            $table->foreignId('teacherID')->constrained('users')->onDelete('cascade');
            $table->string('request_day');
            $table->string('request_time');
            $table->string('request_subject');
            $table->string('request_reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
