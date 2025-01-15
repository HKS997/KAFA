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
        Schema::create('timetables', function (Blueprint $table) {

            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('timetable_classname');
            $table->timestamps();
            $table->string('monday1');
            $table->string('monday2');
            $table->string('monday3');
            $table->string('monday4');
            $table->string('monday5');
            $table->string('tuesday1');
            $table->string('tuesday2');
            $table->string('tuesday3');
            $table->string('tuesday4');
            $table->string('tuesday5');
            $table->string('wednesday1');
            $table->string('wednesday2');
            $table->string('wednesday3');
            $table->string('wednesday4');
            $table->string('wednesday5');
            $table->string('Thursday1');
            $table->string('Thursday2');
            $table->string('Thursday3');
            $table->string('Thursday4');
            $table->string('Thursday5');
            $table->string('Friday1');
            $table->string('Friday2');
            $table->string('Friday3');
            $table->string('Friday4');
            $table->string('Friday5');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};
