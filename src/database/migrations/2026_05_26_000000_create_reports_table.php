<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('project_title');
            $table->text('short_description');
            $table->text('problem_analysis');
            $table->json('system_features')->nullable();
            $table->text('architecture');
            $table->json('tech_stack')->nullable();
            $table->json('diagrams')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
