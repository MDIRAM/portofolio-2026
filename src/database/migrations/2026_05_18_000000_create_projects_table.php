<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->json('technologies')->nullable();
            $table->string('status')->default('Proposal');
            $table->unsignedTinyInteger('progress')->default(0);
            $table->text('problem_analysis')->nullable();
            $table->json('system_requirements')->nullable();
            $table->text('architecture')->nullable();
            $table->json('diagram_steps')->nullable();
            $table->string('report_file')->nullable();
            $table->string('github_url')->nullable();
            $table->string('live_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
