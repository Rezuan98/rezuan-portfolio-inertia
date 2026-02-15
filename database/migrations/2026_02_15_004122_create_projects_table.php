<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Project title
            $table->string('category'); // e.g., E-commerce, Portfolio, POS System
            $table->text('description'); // Project description
            $table->text('features')->nullable(); // Comma-separated features
            $table->text('technologies')->nullable(); // Comma-separated technologies
            $table->string('live_demo_url')->nullable(); // Live demo URL
            $table->string('github_url')->nullable(); // GitHub URL
            $table->integer('order')->default(0); // For sorting
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
