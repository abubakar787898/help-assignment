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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('topic')->nullable();
            $table->string('no_of_reference',25)->nullable();
            $table->unsignedBigInteger('paper_type_id')->nullable(); 
            $table->unsignedBigInteger('dead_line_id')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('education_level_id')->nullable();
            $table->unsignedBigInteger('reference_style_id')->nullable();
            $table->unsignedBigInteger('no_word_id')->nullable();
            $table->foreign('paper_type_id')->references('id')->on('paper_types')->onDelete('cascade');
            $table->foreign('dead_line_id')->references('id')->on('dead_lines')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('education_level_id')->references('id')->on('education_levels')->onDelete('cascade');
            $table->foreign('reference_style_id')->references('id')->on('reference_styles')->onDelete('cascade');
            $table->foreign('no_word_id')->references('id')->on('no_words')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
