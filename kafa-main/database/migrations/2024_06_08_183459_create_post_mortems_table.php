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
        Schema::create('post_mortems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_id'); // Foreign key column
            $table->string('postDescription');
            $table->date('postDate');
            $table->string('postStatus');
            $table->timestamps();

            // Define the foreign key constraint with cascade delete
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_mortems');
    }
};
