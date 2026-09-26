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
        Schema::create('research_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('principal_investigator'); // Project supervisor / PI name
            $table->string('research_area')->nullable(); // e.g. Plant Abiotic Stress, Genomics
            $table->string('funding_source')->nullable();
            $table->decimal('budget', 12, 2)->nullable();
            $table->enum('status', ['upcoming', 'ongoing', 'completed'])->default('upcoming');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('image')->nullable(); // uploaded image path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_projects');
    }
};
